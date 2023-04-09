<?php

namespace App\Console;

use App\Jobs\PruneOldPostsJob;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {

        // get all posts older than 2 years
        //$posts = Post::where('created_at', '<', Carbon::now()->subYears(2))->get();


        // schedule job to run every 20 seconds
        //$schedule->job(PruneOldPostsJob::dispatch())->everyMinute();

        //$schedule->job(new PruneOldPostsJob)->dailyAt("00:00");
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
