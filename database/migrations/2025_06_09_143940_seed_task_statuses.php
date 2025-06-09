<?php

use App\Models\TaskStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        TaskStatus::query()->create([
            'title' => 'К выполнению'
        ]);
        TaskStatus::query()->create([
            'title' => 'В работе'
        ]);
        TaskStatus::query()->create([
            'title' => 'Выполнена'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
