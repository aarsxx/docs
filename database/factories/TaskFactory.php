<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\TaskGroup;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $startDate = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $dueDate = $this->faker->dateTimeBetween($startDate, '+1 month');

        return [
            'user_id' => User::factory(),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence,
            'frequency' => $this->faker->randomElement(['daily', 'weekly', 'monthly', 'yearly']),
            'duration' => $this->faker->numberBetween(15, 120),
            'task_group_id' => TaskGroup::factory(),
            'start_date' => $startDate,
            'due_date' => $dueDate,
            'completed' => $this->faker->boolean(50),
        ];
    }
}
