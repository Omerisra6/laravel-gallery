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

                <x-video :video="$video"/>
            @endforeach

            {{ $videos->links("vendor/pagination/default") }}

        </div>

    </div>
@endsection

@section( 'after-content' )
    <x-download-video-pop></x-download-video-pop>
@endsection
    
@section( 'scripts' )
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>
    <script type="module" src="{{ asset( 'js/pages/home.js' ) }}" defer></script>
@endsection



