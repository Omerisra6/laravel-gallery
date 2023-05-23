<div class="video" data-vid="{{$video->id}}">
    <div class="display-container">
        <img src="{{asset('videos'.$video->image_display)}}" alt="" class="video-display">
        <div class="image-overlay">

            <div class="overlay-top">

                <h3 class="video-made-for">{{$video->made_for}}</h3>

            </div>

            <a href="/display/{{$video->id}}" class="play-icon-container"><i class="fa fa-play"></i></a>

            <div class="overlay-bottom">

                <div class="title-and-project-container">
                    
                    <h4 class="video-project-number">{{$video->project_number}}</h4>
                    <h2 class="video-title">{{$video->title}}</h2>

                </div>

                <div class="ratio-and-download-container">

                    <h3 class="video-ratio">{{$video->ratio}}</h3>
                    <a href="/api/reduced/{{$video->id}}" class="download-video-button">Download</a>

                </div>
            </div>
        </div>
    </div>  
</div>