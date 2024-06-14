<?php

namespace App\Http\Livewire;

use App\Facades\TaskGroupServiceFacade as TaskGroupService;
use Livewire\Component;

class TaskGroupList extends Component
{
    protected $listeners = ['taskGroupCreated' => 'refreshTaskGroups'];

    public function refreshTaskGroups()
    {
        // Fetch and update the task groups here
        $this->taskgroups = TaskGroupService::all();
    }

    public function render()
    {
        $taskgroups = TaskGroupService::getUserTaskGroup(); // Fetch the task groups (you can adjust this query as needed)
        return view('livewire.task-group', ['taskgroups' => $taskgroups]);
    }
}
