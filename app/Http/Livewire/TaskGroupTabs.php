<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Facades\TaskGroupServiceFacade as TaskGroupService;
use App\Facades\TaskServiceFacade as TaskService;

class TaskGroupTabs extends Component
{

    public $activeGroup;
    public $taskGroups;

    public function showGroup($groupId)
    {
        $this->activeGroup = $groupId;
        $this->emit('showGroup', $groupId);
    }

    public function render()
    {
        $this->tasks = TaskService::getPendingTasksGroupedByDate();
        $taskgroups = TaskGroupService::getUserTaskGroup();
        //dd($this->taskGroups);
        return view('livewire.task-group-tabs', ['taskgroups' => $taskgroups]);
    }
}
