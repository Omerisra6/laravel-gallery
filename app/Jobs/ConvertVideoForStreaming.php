<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use FFMpeg\Format\Video\X264;


use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class ConvertVideoForStreaming implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $oldPath;
    private $newPath;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($newPath, $oldPath)
    {
        $this->oldPath = $oldPath;
        $this->newPath = $newPath;
       
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle( )
    {   

        $midBitrate = (new X264('aac') )->setKiloBitrate(6000);

        $file = FFMpeg::fromDisk('backup')->open($this->oldPath);
        $file->export()
        ->inFormat($midBitrate)
        ->toDisk('backup')
        ->save($this->newPath);

    }
}

