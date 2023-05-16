@extends( 'layouts.app' )
@section( 'styles' )
    <script src="https://kit.fontawesome.com/ea6d546e2a.js" crossorigin="anonymous"></script>
    <link href="{{ url('/css/welcome.css') }}" rel="stylesheet"/>
    <link href="{{ url('/css/loader.css') }}" rel="stylesheet"/>
    <base href="{{env('APP_URL');}}" />
@endsection


@section( 'content' )
    <div class="pagi-container">
        <div class="scrolling-pagination">
            @if ( count ($videos) == 0)
            <h1>Nothing to show here</h1>
            @endif
            @foreach ( $videos as $video ) 
            <div class="video" data-vid="{{$video->id}}">

                <a class="display-container"  href="/display?id={{$video->id}}">
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
                    <i class="fa fa-download theme-color" data-vid="{{$video->id}}" onclick="showDownload(event)"></i>
                </div>

                

            
            </div>

            @endforeach

            {{ $videos->links("vendor/pagination/default") }}



        </div>


    </div>

    <div class="download-pop-container invisible">
        <div class="download-pop-wrapper">
            <i class="fa fa-times close-download" onclick="closeDownload()"></i>
            <div class="download-links">
                <a href="" class="download-original-video" target="_blank" download>Download best quality</a>
                <a href="" class="download-reduced-video" target="_blank" download>Download reduced quality</a>
            </div>
        </div>
    </div>        

@endsection

    
@section( 'scripts' )
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>

    <script type="text/javascript">
        $('ul.pagination').hide();
        $(function() {
            $('.scrolling-pagination').jscroll({
                autoTrigger: true,
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.scrolling-pagination',
                loadingHtml: '<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>',
                callback: function() {
                    $('ul.pagination').remove();    
                }
            });
        });
    
    </script>
@endsection



