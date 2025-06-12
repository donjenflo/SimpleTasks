@component('mail::message')
    # Статус задачи изменен

    Задача **#{{ $task->id }}** ({{ $task->title }}) была переведена в статус "**{{ $status }}**".

    Спасибо,<br>
    {{ config('app.name') }}
@endcomponent
