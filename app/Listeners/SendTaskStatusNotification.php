<?php

namespace App\Listeners;

use App\Events\TaskStatusChanged;
use App\Models\TaskStatus;
use App\Notifications\TaskStatusNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendTaskStatusNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(TaskStatusChanged $event)
    {
        $newStatusText = match ($event->newStatusId ){
            TaskStatus::FOR_WORK_STATUS_ID => 'К выполнению',
            TaskStatus::IN_WORK_STATUS_ID => 'В работе',
            TaskStatus::COMPLETED_STATUS_ID => 'Выполнена'
        };


        if (in_array($newStatusText, ['В работе', 'Выполнена'])) {
            $users = $event->task->employees;

            Log::info("Отправка  уведомлений для задачи #{$event->task->id}", [
                'users_count' => $users->count(),
                'new_status' => $newStatusText
            ]);

            foreach ($users as $user) {
                try {
                    $user->notify(new TaskStatusNotification($event->task, $newStatusText));
                    Log::info("Уведомления отправлены пользователю {$user->email} (ID: {$user->id})");
                } catch (\Exception $e) {
                    Log::error("Ошибка отправки уведомлений пользователю {$user->email}: " . $e->getMessage());
                }
            }
        }
    }
}
