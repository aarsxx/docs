<?php

namespace App\Facades;

use App\Services\TaskGroupService;
use Illuminate\Support\Facades\Facade;

/**
 * Class TaskGroupServiceFacade
 *
 * @package App\Facades
 * @method static \App\Models\TaskGroup create(array $attributes)
 * @method static \App\Models\TaskGroup update(array $attributes, \App\Models\TaskGroup $taskGroup)
 * @method static \App\Models\TaskGroup|null find(int $id)
 * @method static \Illuminate\Support\Collection all()
 * @method static void delete(\App\Models\TaskGroup $task)
 */
class TaskGroupServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return TaskGroupService::class;
    }
}
