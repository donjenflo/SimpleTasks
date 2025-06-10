<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group Employees
 */
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

    public function test_employee_index(): void
    {
        $response = $this->get('/api/employees');
        $response->assertStatus(200);
    }

    public function test_employee_create(): void
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => bcrypt('password'),
        ];
        $response = $this->json('POST', '/api/employee', $data);
        $response->assertStatus(201);
    }
}
