<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'duedate' => $this->faker->dateTimeThisMonth,
        ];
    }

    /**
     * Associates the project to a user(manager) and developers
     *
     * @var id $project that was just created
     */
    public function configure()
    {
        return $this->afterMaking(function (Project $project) {
            $manager = User::all()->random();
            $project->manager_id = $manager->id;
        })->afterCreating(function (Project $project) {
            $users = User::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $project->developers()->sync($users);
        });
    }
}