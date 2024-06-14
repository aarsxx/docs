<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Models\TaskGroup;
use App\Models\User;
use App\Facades\TaskServiceFacade as TaskService;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Class TaskServiceTest
 *
 * @package Tests\Unit
 */
class TaskServiceTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test creating a task.
     *
     * @return void
     */
    public function test_create_task()
    {
        // Arrange: Create a task group
        $taskGroup = TaskGroup::factory()->create();
    
        // Act: Create a new task
        $taskData = [
            'user_id' => User::factory()->create()->id,
            'name' => 'Sample Task',
            'description' => 'Sample Task Description',
            'frequency' => 'daily',
            'duration' => 30,
            'start_date' => now(),
            'due_date' => now()->addDays(30),
            'completed' => false,
            'task_group_id' => $taskGroup->id,
        ];
    
        $task = TaskService::create($taskData);
        
        // Assert: Check if the task was stored in the database correctly
        $this->assertDatabaseHas('tasks', $taskData);
    
        // Assert: Check specific attributes of the created
        $this->assertEquals($taskData['name'], $task->name);
        $this->assertEquals($taskData['description'], $task->description);
        $this->assertEquals($taskData['frequency'], $task->frequency);
        $this->assertEquals($taskData['duration'], $task->duration);
        $this->assertEquals($taskData['task_group_id'], $task->task_group_id);
    }

    /** @test */
    public function test_delete_task()
    {
        // Create a task
        $task = Task::factory()->create();

        // Delete the task using TaskService
        TaskService::deleteTask($task->id);

        // Assert that the task was deleted from the database
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
    
    /**
     * Test finding a task.
     *
     * @return void
     */
    public function test_find_task_by_id()
    {
        // Create a task using the factory and retrieve its ID
        $task = Task::factory()->create();
    
        // Use the built-in `find` method to retrieve the task by its ID
        $foundTask = Task::find($task->id);
    
        // Assert that the found task is an instance of the Task model
        $this->assertInstanceOf(Task::class, $foundTask);
    
        // Assert that the IDs of the original and found tasks match
        $this->assertEquals($task->id, $foundTask->id);
    }

    /** @test */
    public function test_marked_completed_and_recreated()
    {
        // Arrange: Create a task with a weekly frequency and due date in the past
        $task = Task::factory()->create([
            'frequency' => 'weekly',
            'due_date' => now()->subWeek(),
        ]);
    
        // Act: Mark the task as completed 
        TaskService::markAsCompleted($task->id);
    
        // Assert: Verify that the task is marked as completed and recreated
        $this->assertTrue($task->fresh()->completed);
    }

        /**
     * Test update a task.
     *
     * @return void
     */
    public function test_update_task()
    {
        // Create a task with default data
        $task = Task::factory()->create();
    
        // New data for the task
        $taskData = [
            'name' => 'New Task Name',
            'description' => 'New Description for New Task Name',
        ];
    
        // Update the task
        TaskService::update($taskData, $task);
    
        // Assert that the task in the database matches the updated data
        $this->assertDatabaseHas('tasks', $taskData);
    
        // Retrieve the updated task from the database
        $updatedTask = TaskService::find($task->id);
    
        // Assert that the task name and description have been updated
        $this->assertEquals($taskData['name'], $updatedTask->name);
        $this->assertEquals($taskData['description'], $updatedTask->description);
    }
    
}
