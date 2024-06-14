<?php

namespace App\Http\Livewire;
use App\Facades\TaskGroupServiceFacade as TaskGroupService;
use App\Facades\TaskServiceFacade as TaskService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateTask extends Component
{
    // Define public properties to store form input values
    public $task_group_id;
    public $name;
    public $description;
    public $frequency;
    public $duration=5;
    public $start_date;
    public $completed;
    // Define a public property to store whether a task is being created
    public $creatingTask = false;

    // Define validation rules for form input values
    protected function rules(): array
    {
        return [
            'task_group_id' => 'required|exists:task_groups,id',
            'name' => [
                'required',
                'max:255',
                Rule::unique('tasks', 'name')
                    ->where('user_id', Auth::id())
                    ->where(function ($query) {
                        $query->whereNull('completed')
                            ->orWhere('completed', false);
                    })
            ],
            'description' => 'nullable|string',
            'frequency' => 'required|in:once,daily,weekly,monthly,yearly',
            'duration' => 'required|numeric|min:1',
            'start_date' => 'required|date',
            'completed' => 'nullable|boolean',
        ];
    }


    // Define options for the frequency select input
    public $frequencyOptions = [
        'once' => 'Once',
        'daily' => 'Daily',
        'weekly' => 'Weekly',
        'monthly' => 'Monthly',
        'yearly' => 'Yearly',
    ];

    // Define a public property to store the available task groups
    public $taskGroups;

    // Define the component's mount method
    public function mount()
    {
        // Load the available task groups into the $taskGroups property
        $this->taskGroups = TaskGroupService::getUserTaskGroup();
    }

    // Define the component's createTask method, which will be called when the form is submitted
    public function createTask()
    {
        // Validate the form input values
        $validatedData = $this->validate();
        // Get the logged-in user's ID
        $userId = Auth::id();
       // Set a flag to indicate that the task is being created
        $this->creatingTask = true;
        //set the task due_date
        $validatedData['due_date']=TaskService::getDueDate($this->start_date,$this->duration);
        try {
            // Create a new task with the input values and the logged-in user's ID
            TaskService::create([
                'task_group_id' => $validatedData['task_group_id'],
                'user_id' => $userId,
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'frequency' => $validatedData['frequency'],
                'duration' => $validatedData['duration'],
                'start_date' => $validatedData['start_date'],
                'due_date' => $validatedData['due_date'],
                'completed' => $validatedData['completed']??false,
            ]);
            // Reset the form input values
            $this->reset(['name','description']);
            // Emit a "taskCreated" event, which the parent component can listen for and use to update its data
            $this->emit('taskCreated');
            // Set the flag to indicate that the task has been created
            $this->creatingTask = false;
            // Store a success flash message in the session
            session()->flash('success', 'Task created successfully.');


        } catch (\Exception $e) {
            // Set the flag to indicate that the task has been created
            $this->creatingTask = false;
            // Store a failed flash message in the session
            session()->flash('failed', $e->getMessage());
        }
    }
    
    public function render()
    {
        // Load the available task groups into the $taskGroups property
        $this->taskGroups = TaskGroupService::getUserTaskGroup();
        return view('livewire.create-task');
    }


}
