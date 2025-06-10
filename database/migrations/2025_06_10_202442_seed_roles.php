<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Role::create(['name' => 'Программист', 'guard_name' => 'api']);
        Role::create(['name' => 'Менеджер',  'guard_name' => 'api']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
