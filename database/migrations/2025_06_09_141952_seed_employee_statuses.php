<?php

use App\Models\EmployeeStatus;
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
        EmployeeStatus::query()->create([
            'title' => 'Работает'
        ]);
        EmployeeStatus::query()->create([
            'title' => 'В отпуске'
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
