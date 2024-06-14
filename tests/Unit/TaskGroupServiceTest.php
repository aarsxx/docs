<?php
namespace Tests\Unit;

use App\Models\TaskGroup;
use App\Models\User;
use App\Facades\TaskGroupServiceFacade as TaskGroupService;;
use Tests\TestCase;

class TaskGroupServiceTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

    }

    public function test_create_group()
    {
        // Create a user and task group data
        $user = User::factory()->create();
        $taskGroupData = [
            'name' => 'Test Task Group',
            'description' => 'This is a test task group.',
            'user_id' => $user->id,
        ];

        // Create a task group using the service
        $taskGroup = TaskGroupService::create($taskGroupData);

        // Assert that the task group exists in the database
        $this->assertDatabaseHas('task_groups', $taskGroupData);

        // Assert individual attributes
        $this->assertEquals($taskGroupData['name'], $taskGroup->name);
        $this->assertEquals($taskGroupData['description'], $taskGroup->description);
        $this->assertEquals($taskGroupData['user_id'], $taskGroup->user_id);
    }

    public function test_get_task_group_by_id()
    {
        $taskGroup = TaskGroup::factory()->create();
    
        $retrievedTaskGroup = TaskGroupService::find($taskGroup->id);
    
        $this->assertTrue($taskGroup->is($retrievedTaskGroup));
    }

    public function test_update_group()
    {
        $taskGroup = TaskGroup::factory()->create();

        $taskGroupData = [
            'name' => 'New Name',
            'description' => 'New Description',
        ];

        TaskGroupService::update($taskGroupData, $taskGroup);

        $this->assertDatabaseHas('task_groups', $taskGroupData);

        $updatedTaskGroup = TaskGroupService::find($taskGroup->id);

        $this->assertEquals($taskGroupData['name'], $updatedTaskGroup->name);
        $this->assertEquals($taskGroupData['description'], $updatedTaskGroup->description);
    }

    public function test_get_all_groups()
    {
        $taskGroups = TaskGroup::factory(3)->create();

        $retrievedTaskGroups = TaskGroupService::all();

        $this->assertGreaterThanOrEqual($taskGroups->count(), $retrievedTaskGroups->count());
    }
    
}
