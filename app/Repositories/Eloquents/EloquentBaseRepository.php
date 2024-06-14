<?php

namespace App\Repositories\Eloquents;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentBaseRepository
 * This EloquentBaseRepository is an abstract class
 * that provides a basic structure for Eloquent model repositories.
 * It contains a constructor that accepts a Model instance and assigns it to the protected $model property.
 * This class can now be extended by other Eloquent repository classes in your application, such as the EloquentTaskRepository.
 * @package App\Repositories
 */
abstract class EloquentBaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * EloquentBaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
