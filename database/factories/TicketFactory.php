<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\ProjectAndTicketNotification;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

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
     * Associates the ticket to a existing project and a developer from that project
     *
     * @var id $ticket that was just created
     */
    public function configure()
    {
        return $this->afterMaking(function (Ticket $ticket) {
            $project = Project::all()->random();
            $developer = $project->developers->random();

            $ticket->project_id = $project->id;
            $ticket->developer_id = $developer->id;
        })->afterCreating(function (Ticket $ticket) {
            $ticket->developer->notify(new ProjectAndTicketNotification(User::all()->first(), $ticket, 'Assign Ticket'));
        });
    }
}
