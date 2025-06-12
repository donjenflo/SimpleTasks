<?php

namespace App\Console\Commands;

use App\Models\EmployeeStatus;
use App\Models\Task;
use App\Models\User;
use Illuminate\Console\Command;

class TaskAttachCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:task-attach-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasksWithoutEmployee = Task::query()->whereDoesntHave('employees')->get();
        $employees = User::query()->where('employee_status_id', '!=', EmployeeStatus::VACATION_STATUS_ID)->get();
        foreach ($tasksWithoutEmployee as $task) {
            try {
                $task->employees()->attach($employees->random());
            } catch (\Throwable) {
                continue;
            }
        }
    }
}
