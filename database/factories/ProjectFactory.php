<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use App\Notifications\ProjectAndTicketNotification;
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
            $manager = User::role('manager')->get()->random();
            $project->manager_id = $manager->id;

             // randomly assigned priority
             $priority = rand(1, 3);
             if ($priority === 1) {
                 $project->priority = 'low';
             } elseif ($priority === 2) {
                 $project->priority = 'medium';
             }
             // else $priority is 3 and doesn't change default priority (high)
 
             // randomly assigned status
             $status = rand(1, 4);
             if ($status === 1) {
                 $project->status = 'completed';
             } elseif ($status === 2) {
                 $project->status = 'submitted';
             } elseif ($status === 3) {
                 $project->status = 'in_progress';
             }
             // else $status is 4 and doesn't change default status (assigned)
 
        })->afterCreating(function (Project $project) {
            $users = User::role('developer')->get()->take(rand(1, 8))->pluck('id');
            $project->developers()->sync($users);

            foreach ($project->developers as $developer) {
                $developer->notify(new ProjectAndTicketNotification(User::all()->first(), $project, 'Project', 'assign'));
            }
        });
    }
}