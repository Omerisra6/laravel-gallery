<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Services\VideoAnalyticsService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VideoAnalyticsController extends Controller
{
    /**
     * Video analytics service instance.
     *
     * @var VideoAnalyticsService
     */
    protected $analyticsService;

    /**
     * Create a new VideoAnalyticsController instance.
     *
     * @param VideoAnalyticsService $analyticsService
     * @return void
     */
    public function __construct(VideoAnalyticsService $analyticsService)
    {
        $this->analyticsService = $analyticsService;
    }

    /**
     * Show the video analytics dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('analytics.dashboard');
    }

    /**
     * Get video analytics data for the dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function dashboardData(Request $request)
    {
        // Implement logic to fetch and format dashboard data
        // Use the VideoAnalyticsService to retrieve necessary data

        $startDate = $request->input('startDate', Carbon::now()->subDays(30)->toDateString());
        $endDate = $request->input('endDate', Carbon::now()->toDateString());

        // Fetch overall view and engagement counts
        $totalViews = VideoView::whereBetween('created_at', [$startDate, $endDate])->count();
        $totalEngagements = VideoEngagement::whereBetween('created_at', [$startDate, $endDate])->count();

        // Fetch top videos by views
        $topVideosByViews = Video::withCount('views')
            ->orderByDesc('views_count')
            ->take(5)
            ->get();

        // Fetch top videos by engagements
        $topVideosByEngagements = Video::withCount('engagements')
            ->orderByDesc('engagements_count')
            ->take(5)
            ->get();

        // Prepare response data
        $data = [
            'totalViews' => $totalViews,
            'totalEngagements' => $totalEngagements,
            'topVideosByViews' => $topVideosByViews,
            'topVideosByEngagements' => $topVideosByEngagements,
            // Add more data as needed
        ];

        return response()->json($data);
    }

    /**
     * Show video analytics report.
     *
     * @param Video $video
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function report(Video $video, Request $request)
    {
        $startDate = $request->input('startDate', Carbon::now()->subDays(30)->toDateString());
        $endDate = $request->input('endDate', Carbon::now()->toDateString());

        $report = $this->analyticsService->generateReport($video, $startDate, $endDate);

        return view('analytics.report', compact('video', 'report', 'startDate', 'endDate'));
    }

    /**
     * Export video analytics report.
     *
     * @param Video $video
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportReport(Video $video, Request $request)
    {
        $startDate = $request->input('startDate', Carbon::now()->subDays(30)->toDateString());
        $endDate = $request->input('endDate', Carbon::now()->toDateString());

        $report = $this->analyticsService->generateReport($video, $startDate, $endDate);

        // Generate CSV file from report data
        $csvData = $this->generateReportCsv($report);

        // Create a unique filename for the export
        $filename = 'video_analytics_report_' . $video->id . '_' . now()->format('YmdHis') . '.csv';

        // Return the CSV file as a download response
        return response()->streamDownload(function () use ($csvData) {
            echo $csvData;
        }, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }

    /**
     * Generate CSV data from the video analytics report.
     *
     * @param array $report
     * @return string
     */
    protected function generateReportCsv(array $report)
    {
        // Implement logic to convert the report data into CSV format
        // You can use a library like League\Csv or manually build the CSV string

        // Example manual CSV generation:
        $csv = "Date,Views,Likes,Comments,Shares\n";

        foreach ($report['viewCounts'] as $date => $viewCount) {
            $likes = $report['engagementCounts'][$date]['like'] ?? 0;
            $comments = $report['engagementCounts'][$date]['comment'] ?? 0;
            $shares = $report['engagementCounts'][$date]['share'] ?? 0;

            $csv .= "{$date},{$viewCount},{$likes},{$comments},{$shares}\n";
        }

        return $csv;
    }
}