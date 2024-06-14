<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Facades\TaskGroupServiceFacade as TaskGroupService;

class CreateTaskGroup extends Component
{

    public $name;
    public $description;
    // Define a public property to store whether a task is being created
    public $creatingTaskGroup = false;
    // Define validation rules for form input values
    protected function rules(): array
    {
        return [
            'name' => 'required|max:255|unique:task_groups,name,NULL,id,user_id,' . Auth::id(),
            'description' => 'required|max:255',
        ];
    }

    public function createTaskGroup()
    {
        // Validate the form input values
        $validatedData = $this->validate();
        // Get the logged-in user's ID
        $userId = Auth::id();
        // Set a flag to indicate that the task is being created
        $this->creatingTaskGroup = true;
        try {
            // Create a new task with the input values and the logged-in user's ID
            TaskGroupService::create([
                'user_id' => $userId,
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
            ]);
            // Reset the form input values
            $this->reset();
            // Emit a "taskGroupAdded" event, which the parent component can listen for and use to update its data
            $this->emit('taskGroupCreated');
            // Set the flag to indicate that the task has been created
            $this->creatingTaskGroup = false;
            // Store a success flash message in the session
            session()->flash('success', 'Task Group created successfully.');

        } catch (\Exception $e) {
            // Set the flag to indicate that the task has been created
            $this->creatingTaskGroup = false;
            // Store a failed flash message in the session
            session()->flash('failed', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.create-task-group');
    }
}
