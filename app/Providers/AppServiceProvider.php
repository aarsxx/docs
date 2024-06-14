<?php

namespace App\Providers;

use App\Facades\TaskGroupServiceFacade;
use App\Facades\TaskServiceFacade;
use App\Repositories\Eloquents\EloquentTaskGroupRepository;
use App\Repositories\Eloquents\EloquentTaskRepository;
use App\Repositories\Interfaces\TaskGroupRepository;
use App\Repositories\Interfaces\TaskRepository;
use App\Services\TaskGroupService;
use App\Services\TaskService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind task repositories and services.
        $this->bindTaskRepositories();
        $this->bindTaskServices();

        // Bind task group repositories and services.
        $this->bindTaskGroupRepositories();
        $this->bindTaskGroupServices();

        // Register task service facade.
        $this->registerTaskServiceFacade();

        // Register task group service facade.
        $this->registerTaskGroupServiceFacade();
    }

    /**
     * Bind task repositories.
     *
     * @return void
     */
    protected function bindTaskRepositories()
    {
        $this->app->bind(TaskRepository::class, EloquentTaskRepository::class);
    }

    /**
     * Bind task services.
     *
     * @return void
     */
    protected function bindTaskServices()
    {
        $this->app->singleton(TaskService::class, TaskService::class);
    }

    /**
     * Bind task group repositories.
     *
     * @return void
     */
    protected function bindTaskGroupRepositories()
    {
        $this->app->bind(TaskGroupRepository::class, EloquentTaskGroupRepository::class);
    }

    /**
     * Bind task group services.
     *
     * @return void
     */
    protected function bindTaskGroupServices()
    {
        $this->app->singleton(TaskGroupService::class, TaskGroupService::class);
    }

    /**
     * Register task service facade.
     *
     * @return void
     */
    protected function registerTaskServiceFacade()
    {
        App::bind('TaskService', function () {
            return new TaskServiceFacade();
        });
    }

    /**
     * Register task group service facade.
     *
     * @return void
     */
    protected function registerTaskGroupServiceFacade()
    {
        App::bind('TaskGroupService', function () {
            return new TaskGroupServiceFacade();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        if(config('app.env') === 'production') {
                URL::forceScheme('https');
        }
    }
}
