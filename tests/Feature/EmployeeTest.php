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
        $queryParams = [
            'name' => $this->user->name,
            'email' => $this->user->email,
            'employee_status_id' => 1,
            'orderBy' => 'id',
            'orderDirection' => 'asc',
        ];
        $response = $this->get('/api/employees',$queryParams);
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

    public function test_employee_delete(): void
    {
        $employeeId = User::query()->whereNot('id',$this->user->id)->first()->id;
        $response = $this->delete( '/api/employee/'.$employeeId );
        $response->assertStatus(200);
    }
    public function test_employee_update(): void
    {
        $data = [
            'name' => 'Test Update',
            'email' => 'test@update.com',
            'password' => bcrypt('password'),
        ];
        $employeeId = User::query()->whereNot('id',$this->user->id)->first()->id;
        $response = $this->put( '/api/employee/'.$employeeId, $data );
        $response->assertStatus(200);
    }
}
