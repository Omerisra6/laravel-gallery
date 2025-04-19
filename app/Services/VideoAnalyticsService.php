<?php

namespace App\Services;

use App\Models\Video;
use App\Models\VideoView;
use App\Models\VideoEngagement;
use Illuminate\Support\Facades\DB;

class VideoAnalyticsService
{
    /**
     * Record a video view.
     *
     * @param Video $video
     * @param array $data
     * @return VideoView
     */
    public function recordView(Video $video, array $data): VideoView
    {
        return $video->views()->create($data);
    }

    /**
     * Record a video engagement.
     *
     * @param Video $video
     * @param array $data
     * @return VideoEngagement
     */
    public function recordEngagement(Video $video, array $data): VideoEngagement
    {
        return $video->engagements()->create($data);
    }

    /**
     * Get the total view count for a video.
     *
     * @param Video $video
     * @return int
     */
    public function getViewCount(Video $video): int
    {
        return $video->viewCount();
    }

    /**
     * Get the total watch time for a video in seconds.
     *
     * @param Video $video
     * @return int
     */
    public function getWatchTime(Video $video): int
    {
        return $video->watchTime();
    }

    /**
     * Get the engagement count for a video by type.
     *
     * @param Video $video
     * @param string $type
     * @return int
     */
    public function getEngagementCount(Video $video, string $type): int
    {
        return $video->engagementCount($type);
    }

    /**
     * Get the like count for a video.
     *
     * @param Video $video
     * @return int
     */
    public function getLikeCount(Video $video): int
    {
        return $video->likeCount();
    }

    /**
     * Get the comment count for a video.
     *
     * @param Video $video
     * @return int
     */
    public function getCommentCount(Video $video): int
    {
        return $video->commentCount();
    }

    /**
     * Get the share count for a video.
     *
     * @param Video $video
     * @return int
     */
    public function getShareCount(Video $video): int
    {
        return $video->shareCount();
    }

    /**
     * Get the view counts for a video over a given time period.
     *
     * @param Video $video
     * @param string $startDate
     * @param string $endDate
     * @return array
     */
    public function getViewCountsOverTime(Video $video, string $startDate, string $endDate): array
    {
        return $video->views()
            ->selectRaw('DATE(created_at) AS date, COUNT(*) AS count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();
    }

    /**
     * Get the engagement counts for a video over a given time period.
     *
     * @param Video $video
     * @param string $startDate
     * @param string $endDate
     * @return array
     */
    public function getEngagementCountsOverTime(Video $video, string $startDate, string $endDate): array
    {
        return $video->engagements()
            ->selectRaw('DATE(created_at) AS date, type, COUNT(*) AS count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date', 'type')
            ->get()
            ->mapToGroups(function ($item, $key) {
                return [$item['date'] => [$item['type'] => $item['count']]];
            })
            ->map(function ($item) {
                return $item->collapse();
            })
            ->toArray();
    }

    /**
     * Get the top videos by view count.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTopVideosByViewCount(int $limit = 10)
    {
        return Video::withCount('views')
            ->orderByDesc('views_count')
            ->limit($limit)
            ->get();
    }

    /**
     * Get the top videos by engagement count.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTopVideosByEngagementCount(int $limit = 10)
    {
        return Video::withCount('engagements')
            ->orderByDesc('engagements_count')
            ->limit($limit)
            ->get();
    }
}