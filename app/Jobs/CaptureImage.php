<?php

namespace App\Jobs;

use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CaptureImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $videoPath;
    private $imagePath;
    /**
     * 
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($videoPath, $imagePath)
    {
        $this->videoPath = $videoPath;
        $this->imagePath = $imagePath;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {        
        FFMpeg::fromDisk('backup')
            ->open($this->videoPath)
            ->getFrameFromSeconds(1)
            ->export()
            ->toDisk('backup')
            ->save($this->imagePath);
         
    }
}
