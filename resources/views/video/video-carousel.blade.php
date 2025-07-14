<?php

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Video Carousel</h1>
    <div class="scrollable-videos" style="overflow-x: auto; white-space: nowrap;">
        <div class="videos-container d-flex">
            @foreach($videos as $video)
                <div class="video-item mx-2" style="display: inline-block;">
                    <img src="{{ $video->thumbnail }}" alt="{{ $video->title }}" class="img-fluid" style="max-width: 300px;">
                    <h5 class="mt-2">{{ $video->title }}</h5>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

<style>
.scrollable-videos {
    max-height: 400px;
    overflow-y: hidden;
}

.video-item {
    flex: 0 0 auto;
}
</style>