<?php

namespace App\Youtube;

use DateInterval;
use Illuminate\Support\Facades\Http;

class YoutubeServices
{
  private $key = null;

  public function __construct(string $key)
  {
    $this->key = $key;
  }
  public function getYoutubeVideoDuration(string $video_url): int
  {
   
    // get the video id 
    preg_match('/embed\/(.*)/', $video_url, $matches);
    $id = $matches[1];
    //  call youtube api to get the duration
    $response = Http::get("https://www.googleapis.com/youtube/v3/videos?id={$id}&key={$this->key}&part=contentDetails");
    $duration = (json_decode($response))->items[0]->contentDetails->duration;
    // get interval duration
    $interval_dur = new DateInterval($duration);

    return $interval_dur->s + $interval_dur->i * 60 + $interval_dur->h * 3600;

  }
}
