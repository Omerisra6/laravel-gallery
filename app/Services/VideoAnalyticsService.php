<?php

namespace App\Services;

use App\Models\Video;
use App\Models\VideoEngagement;
use App\Models\VideoView;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class VideoAnalyticsService
{
    /**
     * Record a video view.
     *
     * @param Video $video
     * @param array $data
     * @return void
     */
    public function recordView(Video $video, array $data)
    {
        $data['video_id'] = $video->id;
        $data['user_id'] = auth()->id();

        VideoView::create($data);
    }

    /**
     * Record a video engagement.
     *
     * @param Video $video
     * @param string $type
     * @return void
     */
    public function recordEngagement(Video $video, string $type)
    {
        VideoEngagement::create([
            'video_id' => $video->id,
            'user_id' => auth()->id(),
            'type' => $type,
        ]);
    }

    /**
     * Get video view count.
     *
     * @param Video $video
     * @return int
     */
    public function getViewCount(Video $video)
    {
        return $video->views()->count();
    }

    /**
     * Get video engagement count.
     *
     * @param Video $video
     * @param string|null $type
     * @return int
     */
    public function getEngagementCount(Video $video, string $type = null)
    {
        $query = $video->engagements();

        if ($type) {
            $query->where('type', $type);
        }

        return $query->count();
    }

    /**
     * Get video average watch time.
     *
     * @param Video $video
     * @return float
     */
    public function getAverageWatchTime(Video $video)
    {
        return $video->views()->avg('view_duration');
    }

    /**
     * Get video completion rate.
     *
     * @param Video $video
     * @return float
     */
    public function getCompletionRate(Video $video)
    {
        $totalViews = $video->views()->count();
        $completedViews = $video->views()->where('completed', true)->count();

        return $totalViews > 0 ? ($completedViews / $totalViews) * 100 : 0;
    }

    /**
     * Get view counts for a date range.
     *
     * @param Video $video
     * @param string $startDate
     * @param string $endDate
     * @return array
     */
    public function getViewCountsForRange(Video $video, string $startDate, string $endDate)
    {
        $views = $video->views()
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->get();

        return $views->pluck('count', 'date')->toArray();
    }

    /**
     * Get engagement counts for a date range.
     *
     * @param Video $video
     * @param string $startDate
     * @param string $endDate
     * @return array
     */
    public function getEngagementCountsForRange(Video $video, string $startDate, string $endDate)
    {
        $engagements = $video->engagements()
            ->select(DB::raw('DATE(created_at) as date'), 'type', DB::raw('COUNT(*) as count'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date', 'type')
            ->get();

        $result = [];

        foreach ($engagements as $engagement) {
            $result[$engagement->date][$engagement->type] = $engagement->count;
        }

        return $result;
    }

    /**
     * Get audience demographics.
     *
     * @param Video $video
     * @return array
     */
    public function getAudienceDemographics(Video $video)
    {
        // Implement demographic analysis based on available user data
        // This could include age, gender, location, etc.

        return [];
    }

    /**
     * Generate video analytics report.
     *
     * @param Video $video
     * @param string $startDate
     * @param string $endDate
     * @return array
     */
    public function generateReport(Video $video, string $startDate, string $endDate)
    {
        $viewCounts = $this->getViewCountsForRange($video, $startDate, $endDate);
        $engagementCounts = $this->getEngagementCountsForRange($video, $startDate, $endDate);
        $averageWatchTime = $this->getAverageWatchTime($video);
        $completionRate = $this->getCompletionRate($video);
        $audienceDemographics = $this->getAudienceDemographics($video);

        return [
            'viewCounts' => $viewCounts,
            'engagementCounts' => $engagementCounts,
            'averageWatchTime' => $averageWatchTime,
            'completionRate' => $completionRate,
            'audienceDemographics' => $audienceDemographics,
        ];
    }
}