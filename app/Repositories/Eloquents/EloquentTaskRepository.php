<?php

namespace App\Repositories\Eloquents;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepository;
use Illuminate\Support\Collection;

/**
 * Class EloquentTaskRepository
 *
 * @package App\Repositories
 */
class EloquentTaskRepository extends EloquentBaseRepository implements TaskRepository
{
    /**
     * EloquentTaskRepository constructor.
     *
     * @param Task $model
     */
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     */
    public function create(array $attributes): Task
    {
        return $this->model->create($attributes);
    }

    /**
     * @inheritDoc
     */
    public function update(array $attributes, Task $task): Task
    {
        $task->update($attributes);

        return $task;
    }

    /**
     * @inheritDoc
     */
    public function find(int $id): ?Task
    {
        return $this->model->find($id);
    }

    /**
     * @inheritDoc
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @inheritDoc
     */
    public function delete(Task $task): void
    {
        $task->delete();
    }
    /**
     * Get all pending tasks.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPendingTasks(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->with('taskGroup')->where('completed', false)
            ->where('user_id', auth()->id())
            ->where('due_date', '>=', now()->startOfDay())
            ->orderBy('due_date', 'asc')
            ->get();
    }
}
