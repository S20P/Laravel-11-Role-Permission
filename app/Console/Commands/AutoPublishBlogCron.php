<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Blogs as BlogPost;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
class AutoPublishBlogCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:publish-scheduled-blogs'; 

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Draft Blogs are Auto Published based on Date.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        info("Blogs Auto Published :: Cron Job running at ". now());
        Log::info('cron:auto-publish-blog command started.');
            try {
                // Your logic here

                $today = Carbon::today();
                Log::info('Date => '.$today);

                 // Find blogs where published_at is today and status is false
                $blogsToPublish = BlogPost::whereDate('published_at', $today)
                ->where('status', false)
                ->get();

                 // Update the status of each blog
                foreach ($blogsToPublish as $blog) {
                    $blog->status = true;
                    $blog->save();
                    Log::info('Blog published: Blog ID => ' . $blog->id);
                }
                
                $this->info('Scheduled blogs published successfully.');

            } catch (\Exception $e) {
                Log::error('Error in cron:auto-publish-blog: ' . $e->getMessage());
            }
        Log::info('cron:auto-publish-blog command completed.');
    }

}
