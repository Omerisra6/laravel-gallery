@extends( 'layouts.app' )
@section( 'styles' )
    <link href="{{ url('/css/showVideo.css') }}" rel="stylesheet"/>
    <link href="https://vjs.zencdn.net/7.15.4/video-js.css" rel="stylesheet" />
@endsection

@section( 'content' )

    <div class="show-video-container">

        <div class="video-top-container">
            <a href="/search/{{$video->project_number}}" class="video-project-number-top link">#{{$video->project_number}}</a>
            <span class="seperator"> / </span>
            <div class="video-title-top">{{$video->title}}</div>
        </div>

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

            <div class="detail-options">
                <span class="overview-option detail-option selected-option" data-for="video-overview-container">Overview</span>
                <span class="info-option detail-option" data-for="video-infos-container">Info</span>
                <span class="downloads-option detail-option" data-for="video-downloads-container">Downloads</span>
            </div>

            <div class="video-details-content-container">

                <div class="video-overview-container detail-content visible">
                    <div class="client-container">Client: <a class="client-link link" href="/search/{{$video->made_for}}">{{$video->made_for}}</a></div>
                    <div class="description-container">
                        <div class="description-title">Description:</div>
                        <div class="description-content">{{$video->description ?? 'No description'}}</div>
                    </div>
                </div>


                <div class="video-infos-container detail-content">

                    <div class="video-resolution info-container">
                        <div class="info-title">Resolution:</div> 
                        <div class="info-content">{{$video->resolution}}</div>
                    </div>

                    <div class="video-ratio info-container">
                        <div class="info-title">Ratio:</div> 
                        <div class="info-content">{{$video->ratio}}</div>
                    </div>

                    <div class="video-duration info-container">
                        <div class="info-title">Duration:</div>
                        <div class="info-content">{{$video->duration}}</div>
                    </div>

                    <div class="video-client info-container">
                        <div class="info-title">Client:</div>
                        <div class="info-content"> {{$video->made_for}}</div>
                    </div>
                </div>

                <div class="video-downloads-container detail-content">

                    <div class="vieo-best-quality info-container">
                        <div class="info-title">Best quality:</div> 
                        <a  href="/api/video/{{$video->id}}" class="link" target="_blank" download><i class="fa fa-download download-video-link"></i></a>
                    </div>

                    <div class="video-reduced-quality info-container">
                    <div class="info-title">Reduced quality:</div> 
                        <a href="/api/video/reduced/{{$video->id}}" class="link" target="_blank" download><i class="fa fa-download download-video-link"></i></a>
                    </div>

                </div>
                
            </div>
        </div>
    </div>

@endsection

@section( 'scripts' )
    <script src="https://vjs.zencdn.net/7.15.4/video.min.js"></script>

    <script type="module" src="{{ asset('js/pages/showVideo.js') }}"></script>
@endsection