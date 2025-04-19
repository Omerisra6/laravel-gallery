@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="video-container">
                    <video id="video-player" src="{{ asset('storage/' . $video->path) }}" controls></video>
                </div>
                <h2>{{ $video->title }}</h2>
                <p>{{ $video->description }}</p>
                <div class="video-stats">
                    <span class="view-count">{{ $viewCount }} views</span>
                    <span class="engagement-count">
                        <i class="fas fa-thumbs-up"></i> {{ $likeCount }}
                        <i class="fas fa-comment"></i> {{ $commentCount }}
                        <i class="fas fa-share"></i> {{ $shareCount }}
                    </span>
                </div>
                <div class="engagement-buttons">
                    <button id="like-button" class="btn btn-primary"><i class="fas fa-thumbs-up"></i> Like</button>
                    <button id="share-button" class="btn btn-secondary"><i class="fas fa-share"></i> Share</button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Video Analytics</div>
                    <div class="card-body">
                        <p>Total Views: {{ $totalViews }}</p>
                        <p>Average Watch Time: {{ $averageWatchTime }} seconds</p>
                        <p>Completion Rate: {{ $completionRate }}%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const videoPlayer = document.getElementById('video-player');
            const likeButton = document.getElementById('like-button');
            const shareButton = document.getElementById('share-button');

            // Video view tracking
            videoPlayer.addEventListener('play', function () {
                axios.post('/api/videos/{{ $video->id }}/view')
                    .catch(function (error) {
                        console.error('Error tracking video view:', error);
                    });
            });

            // Video engagement tracking
            likeButton.addEventListener('click', function () {
                axios.post('/api/videos/{{ $video->id }}/engagement', {
                    type: 'like'
                }).then(function (response) {
                    // Update like count in the UI
                    const likeCount = response.data.likeCount;
                    document.querySelector('.engagement-count .fa-thumbs-up').nextSibling.textContent = likeCount;
                }).catch(function (error) {
                    console.error('Error tracking like engagement:', error);
                });
            });

            shareButton.addEventListener('click', function () {
                axios.post('/api/videos/{{ $video->id }}/engagement', {
                    type: 'share'
                }).then(function (response) {
                    // Update share count in the UI
                    const shareCount = response.data.shareCount;
                    document.querySelector('.engagement-count .fa-share').nextSibling.textContent = shareCount;
                }).catch(function (error) {
                    console.error('Error tracking share engagement:', error);
                });
            });
        });
    </script>
@endsection