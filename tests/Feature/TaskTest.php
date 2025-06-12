<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\TaskSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group Tasks
 */
class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
        $this->seed(UserSeeder::class);
        $this->seed(TaskSeeder::class);
        $this->user = User::first();
        $this->actingAs($this->user);


    }

    public function test_task_index(): void
    {
        $queryParams = [
            'title' => 'Test',
            'orderBy' => 'id',
            'orderDirection' => 'asc',
        ];
        $response = $this->get('/api/tasks', $queryParams);
        $response->assertStatus(200);
    }

    public function test_task_create(): void
    {
        $data = [
            'title' => 'Test',
            'description' => 'foo',
        ];
        $response = $this->post('/api/task', $data);
        $response->assertStatus(201);
        $this->post('/api/task', $data);
        $response = $this->post('/api/task', $data);
        //по задаче можно 2 в минуту
        $response->assertStatus(429);
    }

    public function test_task_update(): void
    {
        $data = [
            'title' => 'Test',
            'description' => 'foo',
        ];
        $response = $this->put('/api/task/1', $data);
        $response->assertStatus(200);
    }

    public function  test_task_delete(): void
    {
        $response = $this->delete('/api/task/1');
        $response->assertStatus(200);
    }

    public function test_task_get(): void
    {
        $response = $this->get('/api/task/1');
        $response->assertStatus(200);
    }
    public function test_task_update_status(): void
    {
        $response = $this->put('/api/task/1/status/1');
        $response->assertStatus(200);
    }

    public function test_task_attach_employee(): void
    {
        $response = $this->post('/api/task/1/employee/1');
        $response->assertStatus(200);
    }

    public function test_task_detach_employee(): void
    {
        $response = $this->delete('/api/task/1/employee/1');
        $response->assertStatus(200);
    }


}
