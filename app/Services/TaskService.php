<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepository;
use Carbon\Carbon;
use DateTime;

/**
 * Class TaskService
 *
 * @package App\Services
 */
class TaskService
{
    /**
     * @var TaskRepository
     */
    protected $taskRepository;

    /**
     * TaskService constructor.
     *
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Create a new task.
     *
     * @param array $attributes
     * @return Task
     */
    public function create(array $attributes): Task
    {
        return $this->taskRepository->create($attributes);
    }

    /**
     * Update an existing task.
     *
     * @param array $attributes
     * @param Task $task
     * @return Task
     */
    public function update(array $attributes, Task $task): Task
    {
        return $this->taskRepository->update($attributes, $task);
    }

    /**
     * Find a task by ID.
     *
     * @param int $id
     * @return Task|null
     */
    public function find(int $id): ?Task
    {
        return $this->taskRepository->find($id);
    }

    /**
     * Get all tasks.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all(): \Illuminate\Support\Collection
    {
        return $this->taskRepository->all();
    }

    /**
     * Delete a task.
     *
     * @param Task $task
     */
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

    /**
     *
     * Get all pending tasks grouped by their due date.
     *
     * @return array
     */
    public function getPendingTasksGroupedByDate()
    {
       // Get all pending tasks from the task repository
        $tasks = $this->taskRepository->getPendingTasks();

       // Initialize an empty array to hold the grouped tasks
        $groupedTasks = [];

       // Loop through each task to determine its time group and add it to the appropriate group in the array
        foreach ($tasks as $task) {
            $group = $this->determineTaskTimeGroup($task->due_date);
            // If the group doesn't exist yet, create it
            if (!isset($groupedTasks[$group])) {
                $groupedTasks[$group] = [];
            }

            // Add the task to the appropriate group in the array
            $groupedTasks[$group][] = $task;
        }

          // Return the grouped tasks
        return $groupedTasks;
    }

    /**
     * Determine the task group based on the due date.
     *
     * @param DateTime $dueDate
     * @return string
     */
    public function determineTaskTimeGroup(DateTime $dueDate): string
    {
        $today = now()->startOfDay();
        $tomorrow = now()->addDay()->startOfDay();
        $nextWeek = now()->addWeek()->startOfDay();

        if ($dueDate->lessThanOrEqualTo($today)) {
            return 'Tasks Today';
        } elseif ($dueDate->greaterThan($today) && $dueDate->lessThanOrEqualTo($tomorrow)) {
            return 'Tasks Tomorrow';
        } elseif ($dueDate->greaterThan($tomorrow) && $dueDate->lessThanOrEqualTo($nextWeek)) {
            return 'Tasks Next Week';
        } elseif ($dueDate->greaterThan($nextWeek) && $dueDate->lessThanOrEqualTo($nextWeek->addWeeks(3))) {
            return 'Tasks in the Near Future';
        } else {
            return 'Tasks in the Future';
        }
    }

    /**
     * Mark a task as completed and recreate the task based on its frequency.
     *
     * @param int $taskId
     * @return void
     */
    public function markAsCompleted(int $taskId)
    {
        $task = $this->taskRepository->find($taskId);

        if ($task) {
            $task->update(['completed' => true]);

            $this->recreateTaskBasedOnFrequency($task);
        }
    }

    /**
     * Recreate the task based on its frequency.
     *
     * @param \App\Models\Task $task
     * @return void
     */
    protected function recreateTaskBasedOnFrequency(Task $task)
    {
        $newDueDate = null;

        switch ($task->frequency) {
            case 'daily':
                $newDueDate = $task->due_date->addDay();
                break;
            case 'weekly':
                $newDueDate = $task->due_date->addWeek();
                break;
            case 'monthly':
                $newDueDate = $task->due_date->addMonth();
                break;
            case 'yearly':
                $newDueDate = $task->due_date->addYear();
                break;
        }

        if ($newDueDate) {
            $newTask = $task->replicate()->fill([
                'start_date' => now(),
                'due_date' => $newDueDate,
                'completed' => false,
            ]);

            $this->taskRepository->create($newTask->toArray());
        }
    }
    /**
     * Get the task due_date.
     *
     * @param string $startDate
     * @param int $duration
     * @return string
     */
    public function getDueDate(string $startDate, int $duration): string
    {
        // Parse the start date string into a Carbon instance
        $startDate = now()->parse($startDate);

        // Add the duration to the start date to get the due date
        $dueDate = $startDate->copy()->addDays($duration);

        // Set the time component of the due date to the start of the day
        $dueDate->startOfDay();

        // Return the due date as a string
        return $dueDate->toDateTimeString();
    }
}
