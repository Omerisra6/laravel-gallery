<?php

namespace App\Http\Controllers;

use App\Models\Video;

class HomeController extends Controller
{
    public function show()
    {
        $videosPerPage = 12;
        $videos = Video::latest()->paginate( $videosPerPage ); 
    
        return view('welcome')->with( 'videos', $videos );    
    }
}
