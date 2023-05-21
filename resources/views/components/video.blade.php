<div class="video" data-vid="{{$video->id}}">

    <a class="display-container"  href="/display/{{$video->id}}">
        <img src="{{asset('videos'.$video->image_display)}}" alt="" class="video-display">
        <h4 class="video-duration">{{$video->duration}}</h4>
        <div class="image-overlay">
            <i class="fa fa-play"></i>
        </div>
    </a>  

    <div class="tite-and-time">
        <h2 class="video-title">{{$video->title}}</h2>
    </div>
    <h4 class="video-project-number">project number: {{$video->project_number}}</h4>

    <h6 class="video-time">{{substr($video->created_at, 0, -9);}}</h6>
    <h6 class="video-ratio">{{$video->ratio}}</h3>


    <div class="video-bottom-container">
        <h3 class="video-made-for">{{$video->made_for}}</h3>
        <i class="fa fa-download theme-color download-video-icon download-video-button" data-vid="{{$video->id}}"></i>
    </div>     
    
</div>