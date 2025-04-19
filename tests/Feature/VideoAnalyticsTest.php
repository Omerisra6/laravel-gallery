<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Video;
use App\Services\VideoAnalyticsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideoAnalyticsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test recording a video view.
     *
     * @return void
     */
    public function testRecordVideoView()
    {
        $video = Video::factory()->create();
        $user = User::factory()->create();

        $response = $this->postJson("/api/videos/{$video->id}/view", [
            'user_id' => $user->id,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'TestUserAgent',
            'view_duration' => 60,
            'completed' => true,
        ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'View recorded successfully']);

        $this->assertDatabaseHas('video_views', [
            'video_id' => $video->id,
            'user_id' => $user->id,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'TestUserAgent',
            'view_duration' => 60,
            'completed' => true,
        ]);
    }

    /**
     * Test recording a video engagement.
     *
     * @return void
     */
    public function testRecordVideoEngagement()
    {
        $video = Video::factory()->create();
        $user = User::factory()->create();

        $response = $this->postJson("/api/videos/{$video->id}/engagement", [
            'user_id' => $user->id,
            'type' => 'like',
        ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Engagement recorded successfully']);

        $this->assertDatabaseHas('video_engagements', [
            'video_id' => $video->id,
            'user_id' => $user->id,
            'type' => 'like',
        ]);
    }

    /**
     * Test getting video view count.
     *
     * @return void
     */
    public function testGetVideoViewCount()
    {
        $video = Video::factory()->create();
        $video->views()->createMany(Video::factory()->count(5)->make()->toArray());

        $analyticsService = app(VideoAnalyticsService::class);
        $viewCount = $analyticsService->getViewCount($video);

        $this->assertEquals(5, $viewCount);
    }

    /**
     * Test getting video watch time.
     *
     * @return void
     */
    public function testGetVideoWatchTime()
    {
        $video = Video::factory()->create();
        $video->views()->createMany([
            ['view_duration' => 60],
            ['view_duration' => 120],
            ['view_duration' => 180],
        ]);

        $analyticsService = app(VideoAnalyticsService::class);
        $watchTime = $analyticsService->getWatchTime($video);

        $this->assertEquals(360, $watchTime);
    }

    /**
     * Test getting video engagement count by type.
     *
     * @return void
     */
    public function testGetVideoEngagementCountByType()
    {
        $video = Video::factory()->create();
        $video->engagements()->createMany([
            ['type' => 'like'],
            ['type' => 'like'],
            ['type' => 'comment'],
        ]);

        $analyticsService = app(VideoAnalyticsService::class);
        $likeCount = $analyticsService->getEngagementCount($video, 'like');
        $commentCount = $analyticsService->getEngagementCount($video, 'comment');

        $this->assertEquals(2, $likeCount);
        $this->assertEquals(1, $commentCount);
    }

    /**
     * Test getting video view counts over time.
     *
     * @return void
     */
    public function testGetVideoViewCountsOverTime()
    {
        $video = Video::factory()->create();
        $video->views()->createMany([
            ['created_at' => now()->subDays(2)],
            ['created_at' => now()->subDays(2)],
            ['created_at' => now()->subDay()],
            ['created_at' => now()],
        ]);

        $analyticsService = app(VideoAnalyticsService::class);
        $viewCounts = $analyticsService->getViewCountsOverTime(
            $video,
            now()->subDays(3)->toDateString(),
            now()->toDateString()
        );

        $this->assertCount(3, $viewCounts);
        $this->assertEquals(2, $viewCounts[now()->subDays(2)->toDateString()]);
        $this->assertEquals(1, $viewCounts[now()->subDay()->toDateString()]);
        $this->assertEquals(1, $viewCounts[now()->toDateString()]);
    }

    /**
     * Test getting video engagement counts over time.
     *
     * @return void
     */
    public function testGetVideoEngagementCountsOverTime()
    {
        $video = Video::factory()->create();
        $video->engagements()->createMany([
            ['type' => 'like', 'created_at' => now()->subDays(2)],
            ['type' => 'comment', 'created_at' => now()->subDays(2)],
            ['type' => 'like', 'created_at' => now()->subDay()],
            ['type' => 'share', 'created_at' => now()],
        ]);

        $analyticsService = app(VideoAnalyticsService::class);
        $engagementCounts = $analyticsService->getEngagementCountsOverTime(
            $video,
            now()->subDays(3)->toDateString(),
            now()->toDateString()
        );

        $this->assertCount(3, $engagementCounts);
        $this->assertEquals(1, $engagementCounts[now()->subDays(2)->toDateString()]['like']);
        $this->assertEquals(1, $engagementCounts[now()->subDays(2)->toDateString()]['comment']);
        $this->assertEquals(1, $engagementCounts[now()->subDay()->toDateString()]['like']);
        $this->assertEquals(1, $engagementCounts[now()->toDateString()]['share']);
    }

    /**
     * Test getting top videos by view count.
     *
     * @return void
     */
    public function testGetTopVideosByViewCount()
    {
        $video1 = Video::factory()->create();
        $video1->views()->createMany(Video::factory()->count(10)->make()->toArray());

        $video2 = Video::factory()->create();
        $video2->views()->createMany(Video::factory()->count(5)->make()->toArray());

        $video3 = Video::factory()->create();
        $video3->views()->createMany(Video::factory()->count(3)->make()->toArray());

        $analyticsService = app(VideoAnalyticsService::class);
        $topVideos = $analyticsService->getTopVideosByViewCount(2);

        $this->assertCount(2, $topVideos);
        $this->assertEquals($video1->id, $topVideos[0]->id);
        $this->assertEquals(10, $topVideos[0]->views_count);
        $this->assertEquals($video2->id, $topVideos[1]->id);
        $this->assertEquals(5, $topVideos[1]->views_count);
    }

    /**
     * Test getting top videos by engagement count.
     *
     * @return void
     */
    public function testGetTopVideosByEngagementCount()
    {
        $video1 = Video::factory()->create();
        $video1->engagements()->createMany(Video::factory()->count(10)->make()->toArray());

        $video2 = Video::factory()->create();
        $video2->engagements()->createMany(Video::factory()->count(5)->make()->toArray());

        $video3 = Video::factory()->create();
        $video3->engagements()->createMany(Video::factory()->count(3)->make()->toArray());

        $analyticsService = app(VideoAnalyticsService::class);
        $topVideos = $analyticsService->getTopVideosByEngagementCount(2);

        $this->assertCount(2, $topVideos);
        $this->assertEquals($video1->id, $topVideos[0]->id);
        $this->assertEquals(10, $topVideos[0]->engagements_count);
        $this->assertEquals($video2->id, $topVideos[1]->id);
        $this->assertEquals(5, $topVideos[1]->engagements_count);
    }
}