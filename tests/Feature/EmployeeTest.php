<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
 {
     parent::setUp();
     $this->artisan('migrate');
     $this->seed(UserSeeder::class);
     $this->user = User::first();
     $this->actingAs($this->user);


 }
    public function test_example(): void
    {

        $response = $this->get('/api/employees');

        $response->assertStatus(200);
    }
}
