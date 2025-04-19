<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Services\VideoAnalyticsService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VideoAnalyticsController extends Controller
{
    protected $analyticsService;

    public function __construct(VideoAnalyticsService $analyticsService)
    {
        $this->analyticsService = $analyticsService;
    }

    /**
     * Display the analytics dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function dashboard(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->subDays(30)->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->toDateString());

        $viewCounts = $this->analyticsService->getViewCountsOverTime($startDate, $endDate);
        $engagementCounts = $this->analyticsService->getEngagementCountsOverTime($startDate, $endDate);
        $topVideosByViews = $this->analyticsService->getTopVideosByViewCount();
        $topVideosByEngagement = $this->analyticsService->getTopVideosByEngagementCount();

        return view('analytics.dashboard', compact(
            'viewCounts',
            'engagementCounts',
            'topVideosByViews',
            'topVideosByEngagement',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Display analytics for a specific video.
     *
     * @param Request $request
     * @param Video $video
     * @return \Illuminate\Contracts\View\View
     */
    public function videoAnalytics(Request $request, Video $video)
    {
        $startDate = $request->input('start_date', Carbon::now()->subDays(30)->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->toDateString());

        $viewCount = $this->analyticsService->getViewCount($video);
        $watchTime = $this->analyticsService->getWatchTime($video);
        $likeCount = $this->analyticsService->getLikeCount($video);
        $commentCount = $this->analyticsService->getCommentCount($video);
        $shareCount = $this->analyticsService->getShareCount($video);
        $viewCountsOverTime = $this->analyticsService->getViewCountsOverTime($video, $startDate, $endDate);
        $engagementCountsOverTime = $this->analyticsService->getEngagementCountsOverTime($video, $startDate, $endDate);

        return view('analytics.video', compact(
            'video',
            'viewCount',
            'watchTime',
            'likeCount',
            'commentCount',
            'shareCount',
            'viewCountsOverTime',
            'engagementCountsOverTime',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Record a video view.
     *
     * @param Request $request
     * @param Video $video
     * @return \Illuminate\Http\JsonResponse
     */
    public function recordView(Request $request, Video $video)
    {
        $data = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'ip_address' => 'required|ip',
            'user_agent' => 'required|string',
            'view_duration' => 'required|integer',
            'completed' => 'required|boolean',
        ]);

        $this->analyticsService->recordView($video, $data);

        return response()->json(['message' => 'View recorded successfully']);
    }

    /**
     * Record a video engagement.
     *
     * @param Request $request
     * @param Video $video
     * @return \Illuminate\Http\JsonResponse
     */
    public function recordEngagement(Request $request, Video $video)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:like,comment,share',
        ]);

        $this->analyticsService->recordEngagement($video, $data);

        return response()->json(['message' => 'Engagement recorded successfully']);
    }
}