<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    public function update(User $user,Course $course)
    {
        return $user->id === $course->user_id;
    }
    public function delete(User $user,Course $course)
    {
        return $user->id === $course->user_id;
    }
}
