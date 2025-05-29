<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Carbon\Carbon;

class PublishScheduledPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:publish';

    

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish scheduled posts that are due';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        $posts = Post::where('status', 'scheduled')
            ->where('scheduled_time', '<=', $now)
            ->get();

        if ($posts->isEmpty()) {
            $this->info('No posts to publish now.');
            return 0;
        }

        foreach ($posts as $post) {
            // Mock publishing
            $this->mockPublish($post);

            // Update status
            $post->status = 'published';
            $post->save();

            $this->info("Published post ID {$post->id}");
        }

        return 0;
    }
    protected function mockPublish(Post $post)
    {
        // Simulate sending post to platforms, logging, etc.
        foreach ($post->platforms as $platform) {
            $this->info("Mock publishing Post {$post->id} to {$platform->name}");
            // Here you could queue jobs, log data, or update pivot table status
        }
    }
}
