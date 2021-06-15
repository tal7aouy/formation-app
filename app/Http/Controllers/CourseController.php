<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Episode;
use App\Youtube\YoutubeServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CourseController extends Controller
{

    public function index()
    {
       
        $courses = Course::with('user')->select('courses.*', DB::raw(
            '(SELECT COUNT(DISTINCT(user_id)) FROM completions 
            INNER JOIN episodes ON completions.episode_id = episodes.id 
            WHERE episodes.course_id = courses.id) AS participants'
        ))->addSelect(DB::raw('
               ( SELECT SUM(duration) FROM episodes
               WHERE episodes.course_id = courses.id
       ) AS t_duration'))->withCount('episodes')->orderBy('created_at', 'DESC')->paginate(6);

        return Inertia::render('Courses/Index', [
            'courses' => $courses
        ]);
    }


    public function store(Request $request,YoutubeServices $youtbs)
    {
      
        $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'episodes' => ['required', 'array'],
            'episodes.*.title' => ['required', 'string'],
            'episodes.*.description' => ['required', 'string'],
            'episodes.*.video_url' => ['required', 'url'],
        ]);
        $course = Course::create($request->all());

        foreach ($request->input('episodes') as $episode) {
            $episode['course_id'] = $course->id;
            $episode['duration'] = $youtbs->getYoutubeVideoDuration($episode['video_url']);
            Episode::create($episode);
        }
        return Redirect::route('dashboard')->with('success', 'the course is added successfully');
    }

    public function show(int $id)
    {
        $course = Course::where('id', '=', $id)->with('episodes')->first();
        $completed = auth()->user()->episodes;
        return Inertia::render(
            'Courses/Show',
            [
                'course' => $course,
                'watched' => $completed
            ]
        );
    }

    public function progress(Request $request)
    {
        $id =  $request->input('episodeId');

        $user = auth()->user();
        $user->episodes()->toggle($id);
        return $user->episodes;
    }

    public function edit(int $id)
    {
        $course = Course::where('id', '=', $id)->with('episodes')->first();
        $this->authorize('update', $course);

        return Inertia::render('Courses/Edit', [
            'course' => $course
        ]);
    }

  
    public function update(Request $request, int $id,YoutubeServices $youtbs)
    {
        $course = Course::where('id', '=', $id)->with('episodes')->first();

        $course->update($request->all());
        $course->episodes()->delete();

        foreach ($request->input('episodes') as $episode) {
            $episode['course_id'] = $course->id;
            $episode['duration'] = $youtbs->getYoutubeVideoDuration($episode['video_url']);
            Episode::create($episode);
        }
        return Redirect::route('courses.index')->with('success', 'the course is updated successfully');
    }

   
    public function destroy(int $id)
    {
         $course = Course::where('id', '=', $id)->with('episodes')->first();
         $this->authorize('delete', $course);
         $course->delete();
         return Redirect::route('courses.index')->with('success', 'the course is deleted successfully');
    }
}
