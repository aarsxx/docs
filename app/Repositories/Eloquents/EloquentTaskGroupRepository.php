<?php

namespace App\Repositories\Eloquents;

use App\Models\Task;
use App\Models\TaskGroup;
use App\Repositories\Interfaces\TaskGroupRepository;
use App\Repositories\Interfaces\TaskRepository;
use Illuminate\Support\Collection;

/**
 * Class EloquentTaskGroupRepository
 *
 * @package App\Repositories
 */
class EloquentTaskGroupRepository extends EloquentBaseRepository implements TaskGroupRepository
{
    /**
     * EloquentTaskGroupRepository constructor.
     *
     * @param TaskGroup $model
     */
    public function __construct(TaskGroup $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     */
    public function create(array $attributes): TaskGroup
    {
        return $this->model->create($attributes);
    }

    /**
     * @inheritDoc
     */
    public function update(array $attributes, TaskGroup $taskGroup): TaskGroup
    {
        $taskGroup->update($attributes);

        return $taskGroup;
    }

    /**
     * @inheritDoc
     */
    public function find(int $id): ?TaskGroup
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
    public function delete(TaskGroup $taskGroup): void
    {
        $taskGroup->delete();
    }
    /**
     * Get tasks group belong to logged in user.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUserTaskGroup():  \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->where('user_id', auth()->id())
            ->orderBy('created_at', 'asc')
            ->get();
    }

}
