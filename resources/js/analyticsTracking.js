// resources/js/analyticsTracking.js

// Initialize variables
let videoId;
let userId;
let viewStartTime;
let viewEndTime;

// Capture relevant data when the video starts playing
document.addEventListener('DOMContentLoaded', function() {
    const videoPlayer = document.getElementById('video-player');
    videoId = videoPlayer.dataset.videoId;
    userId = document.getElementById('user-id').value;

    videoPlayer.addEventListener('play', function() {
        viewStartTime = new Date().getTime();
    });
});

// Record the view duration when the video is paused or ends
window.addEventListener('beforeunload', recordViewDuration);
document.addEventListener('visibilitychange', function() {
    if (document.visibilityState === 'hidden') {
        recordViewDuration();
    }
});

// Function to send view duration to the server
function recordViewDuration() {
    viewEndTime = new Date().getTime();
    const viewDuration = Math.round((viewEndTime - viewStartTime) / 1000);

    fetch(`/api/videos/${videoId}/view`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            userId: userId,
            duration: viewDuration
        })
    });
}

// Record user engagement (likes, comments, shares)
document.addEventListener('DOMContentLoaded', function() {
    const likeButton = document.getElementById('like-button');
    const commentForm = document.getElementById('comment-form');
    const shareButton = document.getElementById('share-button');

    likeButton.addEventListener('click', function() {
        recordEngagement('like');
    });

    commentForm.addEventListener('submit', function() {
        recordEngagement('comment');
    });

    shareButton.addEventListener('click', function() {
        recordEngagement('share');
    });
});

// Function to send engagement data to the server
function recordEngagement(engagementType) {
    fetch(`/api/videos/${videoId}/engagement`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            userId: userId,
            type: engagementType
        })
    });
}

// Periodically fetch and update video analytics data
document.addEventListener('DOMContentLoaded', function() {
    fetchVideoAnalytics();
    setInterval(fetchVideoAnalytics, 60000); // Update every 60 seconds
});

// Function to fetch video analytics data from the server
function fetchVideoAnalytics() {
    fetch(`/api/videos/${videoId}/analytics`)
        .then(response => response.json())
        .then(data => {
            updateAnalyticsDisplay(data);
        });
}

// Function to update the analytics display with fetched data
function updateAnalyticsDisplay(analyticsData) {
    document.getElementById('view-count').textContent = analyticsData.viewCount;
    document.getElementById('like-count').textContent = analyticsData.likeCount;
    document.getElementById('comment-count').textContent = analyticsData.commentCount;
    document.getElementById('share-count').textContent = analyticsData.shareCount;
}