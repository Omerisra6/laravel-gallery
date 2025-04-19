<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Services\VideoService;

class TestController extends Controller
{
    protected $videoService;

    /**
     * Create a new controller instance.
     */
    public function __construct(VideoService $videoService)
    {
        $this->videoService = $videoService;
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of test resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::latest()->paginate(10);
        
        return view('test.index', compact('videos'));
    }

    /**
     * Show the form for creating a new test resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('test.create');
    }

    /**
     * Store a newly created test resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url'
        ]);

        $video = new Video();
        $video->title = $request->title;
        $video->description = $request->description;
        $video->url = $request->url;
        $video->user_id = auth()->id();
        $video->save();

        return redirect()->route('videos.index')
            ->with('success', 'Test resource created successfully.');
    }
} 