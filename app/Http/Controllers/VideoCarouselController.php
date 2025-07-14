<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class VideoCarouselController {

    public function index() {
        $videos = Video::orderBy('created_at', 'desc')->get();
        return View::make('video.video-carousel', compact('videos'));
    }

}