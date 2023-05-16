<?php

namespace App\Jobs;

use App\Models\Video;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class VideoCreator implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $video;
    /**
     * 
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($video)
    {
        $this->video = $video;
        
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $video = Video::create([
            'description'    => '',
            'title'          => $this->video['title'],
            'duration'       => $this->video['duration'],
            'key_words'      => $this->video['key_words'],
            'original_video' => $this->video['original_video'],
            'reduced_video'  => $this->video['reduced_video'],
            'image_display'  => $this->video['image_display'],
            'resolution'     => $this->video['resolution'],
            'made_for'       => $this->video['made_for'],
            'project_number' => $this->video['project_number'],
            'ratio'          => $this->video['ratio'], 
        ]);

         
    }
}
