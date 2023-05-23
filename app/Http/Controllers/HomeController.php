<?php

namespace App\Http\Controllers;

use App\Models\Video;

class HomeController extends Controller
{
    public function show()
    {
        $videosPerPage = 9;
        $videos = Video::latest()->paginate( $videosPerPage ); 
  
        return view('home')->with( 'videos', $videos );    
    }
}
