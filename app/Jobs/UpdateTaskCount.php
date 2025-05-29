<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UpdateTaskCount implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
            $users = User::where('is_admin', false)->get();

            foreach ($users as $user) {
                $taskCount = Task::where('assigned_to_id', $user->id)->count();
                Statistic::updateOrCreate(
                    ['user_id' => $user->id],
                    ['task_count' => $taskCount]
                );
            }
    }
}
