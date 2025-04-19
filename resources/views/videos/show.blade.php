@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $video->title }}</div>

                <div class="card-body">
                    <video controls>
                        <source src="{{ $video->url }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>

                    <p class="mt-3">{{ $video->description }}</p>

                    <h5 class="mt-4">Categories:</h5>
                    <ul>
                        @foreach ($video->categories as $category)
                            <li>{{ $category->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection