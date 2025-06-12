<?php

namespace App\Notifications;

use App\Models\TaskStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $task;
    protected $newStatusText;


    /**
     * Create a new notification instance.
     */
    public function __construct($task, $newStatusText)
    {
        $this->task = $task;
        $this->newStatusText = $newStatusText;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Статус задачи #{$this->task->id} изменен")
            ->line("Задача #{$this->task->id} была переведена в статус {$this->newStatusText}");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }


}
