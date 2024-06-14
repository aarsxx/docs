<?php

namespace App\Facades;

use App\Services\TaskService;
use Illuminate\Support\Facades\Facade;

/**
 * Class TaskServiceFacade
 *
 * @package App\Facades
 * @method static \App\Models\Task create(array $attributes)
 * @method static \App\Models\Task update(array $attributes, \App\Models\Task $task)
 * @method static \App\Models\Task|null find(int $id)
 * @method static \Illuminate\Support\Collection all()
 * @method static void delete(\App\Models\Task $task)
 */
class TaskServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return TaskService::class;
    }
}
