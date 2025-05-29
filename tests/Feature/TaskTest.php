<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_task_creation()
    {
        $response = $this->post(route('tasks.store'), [
            'title' => 'Test Task',
            'description' => 'Test Description',
            'assigned_by_id' => 1,
            'assigned_to_id' => 102,
        ]);
    
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', ['title' => 'Test Task']);
    }
}
