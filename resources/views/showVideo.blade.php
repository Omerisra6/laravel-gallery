<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ea6d546e2a.js" crossorigin="anonymous"></script>
    <link href="{{ url('/css/header.css') }}" rel="stylesheet"/>
    <link href="{{ url('/css/welcome.css') }}" rel="stylesheet"/>
    <link href="{{ url('/css/loader.css') }}" rel="stylesheet"/>
    <link href="{{ url('/css/showVideo.css') }}" rel="stylesheet"/>
    <link href="https://vjs.zencdn.net/7.15.4/video-js.css" rel="stylesheet" />

</head>
<html>
    @include('layouts.header')

    <body>
        <div class="container">
            <video
            id="my-video"
            class="video-js vjs-big-play-centered"
            controls
            preload="auto"
            width="640"
            height="264"
            poster="{{asset('videos/'.$video->image_display)}}"
            data-setup="{}">
                <source src="{{asset('videos/'.$video->reduced_video)}}" type="video/mp4" />
            </video>


            <div class="details-container">

                <div class="video-header">

                    <div class="title-and-more">

                        <h1 class="display-title">{{$video->title}}</h1>
                        <div class="more">
                            <h2 class="made-for-display">Client : {{$video->made_for}}</h2>
                            <h5 class="project-number-display">#{{$video->project_number}}</h5>
                        </div>
                        
                    </div>

                    <h6 class="time-created">{{$video->created_at}}</h6>
                </div>
                <div class="display-description">{{$video->description}}</div>

                <a href="api/video/{{ $video->id }}" class="download-video-original" target="_blank" download>Download in best quality</a>
                
            </div>
        </div>

        <script src="https://vjs.zencdn.net/7.15.4/video.min.js"></script>


    </body>     

    <script type="text/javascript" src="{{ asset('js/header.js') }}"></script>

</html>     

    