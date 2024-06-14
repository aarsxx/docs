<?php

namespace App\Repositories\Interfaces;

use App\Models\Task;
use App\Models\TaskGroup;
use Illuminate\Support\Collection;

/**
 * Interface TaskGroupRepository
 */
interface TaskGroupRepository
{
    public function create(array $attributes): TaskGroup;

    public function update(array $attributes, TaskGroup $taskGroup): TaskGroup;

    public function find(int $id): ?TaskGroup;

    public function all(): Collection;

    public function delete(TaskGroup $taskGroup): void;
}
