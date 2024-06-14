<?php

namespace App\Repositories\Interfaces;

use App\Models\Task;
use Illuminate\Support\Collection;

/**
 * Interface TaskRepository
 */
interface TaskRepository
{
    public function create(array $attributes): Task;

    public function update(array $attributes, Task $task): Task;

    public function find(int $id): ?Task;

    public function all(): Collection;

    public function delete(Task $task): void;

    public function getPendingTasks();
}
