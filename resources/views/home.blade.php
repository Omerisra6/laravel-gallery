@extends( 'layouts.app' )
@section( 'styles' )
    <script src="https://kit.fontawesome.com/ea6d546e2a.js" crossorigin="anonymous"></script>
    <link href="{{ url('/css/welcome.css') }}" rel="stylesheet"/>
    <link href="{{ url('/css/components/video.css') }}" rel="stylesheet"/>
    <link href="{{ url('/css/loader.css') }}" rel="stylesheet"/>
    <base href="{{env('APP_URL');}}" />
@endsection


@section( 'content' )
    <div class="pagi-container">

        <div class="videos-container">

            @if ( count ($videos) == 0)

                <h1>Nothing to show here</h1>

            @endif

            @foreach ( $videos as $video ) 

                <x-video :video="$video"/>

            @endforeach
        </div>
        {{ $videos->links("vendor/pagination/default") }}
    </div>
@endsection