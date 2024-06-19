<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

final class RetryFailedRequests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:retry-failed-requests';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retry failed requests command';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Artisan::command('queue:retry-all {queue}', function ($queue) {
            $failedJobs = DB::table('failed_jobs')->where('queue', $queue)->pluck('id');

            if ($failedJobs->isEmpty()) {
                $this->info("No failed jobs found for queue: {$queue}");
                return;
            }

            $this->info("Retrying all failed jobs for queue: {$queue}");

            foreach ($failedJobs as $jobId) {
                Artisan::call('queue:retry', ['id' => $jobId]);
                $this->info("Retried job with ID: {$jobId}");
            }
        })->describe('Retry all failed jobs for a specific queue');
    }
}
