<?php

namespace App\Services;

use App\Models\TaskGroup;
use App\Repositories\Interfaces\TaskGroupRepository;
use Illuminate\Support\Collection;

/**
 * Class TaskGroupService
 *
 * @package App\Services
 */
class TaskGroupService
{
    /**
     * @var TaskGroupRepository
     */
    protected $taskGroupRepository;

    /**
     * TaskGroupService constructor.
     *
     * @param TaskGroupRepository $taskGroupRepository
     */
    public function __construct(TaskGroupRepository $taskGroupRepository)
    {
        $this->taskGroupRepository = $taskGroupRepository;
    }

    /**
     * Create a new task group.
     *
     * @param array $attributes
     * @return TaskGroup
     */
    public function create(array $attributes): TaskGroup
    {
        return $this->taskGroupRepository->create($attributes);
    }
    /**
     * Update an existing task group.
     *
     * @param array $attributes
     * @param TaskGroup $task
     * @return TaskGroup
     */
    public function update(array $attributes, TaskGroup $taskGroup): TaskGroup
    {
        return $this->taskGroupRepository->update($attributes, $taskGroup);
    }

    /**
     * Find a task group by ID.
     *
     * @param int $id
     * @return TaskGroup|null
     */
    public function find(int $id): ?TaskGroup
    {
        return $this->taskGroupRepository->find($id);
    }

    /**
     * Get all task groups.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->taskGroupRepository->all();
    }

    /**
     * Delete a task group.
     *
     * @param TaskGroup $taskGroup
     */
    public function delete(TaskGroup $taskGroup): void
    {
        $this->taskGroupRepository->delete($taskGroup);
    }
    /**
     * Get a task group that belong to logged in user.
     *
     * @return Collection
     */
    public function getUserTaskGroup(): Collection
    {
        return $this->taskGroupRepository->getUserTaskGroup();

    }

}
