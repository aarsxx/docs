<?php

namespace App\Http\Livewire;

use App\Facades\TaskServiceFacade as TaskService;
use Livewire\Component;

class TaskList extends Component
{
    public $tasks; // Store the pending tasks grouped by date
    public $processing = false; // Indicates if a task is being marked as completed

    // Called when the component is mounted
    public function mount()
    {
        // Get the pending tasks grouped by date using TaskService
        $this->tasks = TaskService::getPendingTasksGroupedByDate();
    }

    // Marks a task as completed
    public function markAsCompleted($taskId)
    {
        $this->processing = true; // Set the processing flag to true
        TaskService::markAsCompleted($taskId); // Mark the task as completed using TaskService

        $this->emit('taskCompleted'); // Emit the 'taskCompleted' event
        $this->processing = false; // Set the processing flag to false

        // Flash a success message to the session
        session()->flash('success', 'Task marked as completed.');
    }

    public function deleteTask($taskId)
    {
        // Retrieve the task by ID and delete it
        $task = TaskService::find($taskId);
        if ($task) {
            $task->delete();
            session()->flash('success', 'Task deleted successfully.');
        } else {
            session()->flash('failed', 'Task not found.');
        }
    }

    protected $listeners = ['taskCreated' => 'refreshTasks'];

    public function refreshTasks()
    {
        // Fetch and update the task groups here
        $this->tasks = TaskService::all();
    }

    // Render the component
    public function render()
    {   
        $this->tasks = TaskService::getPendingTasksGroupedByDate();
        return view('livewire.task-list');
    }


}
