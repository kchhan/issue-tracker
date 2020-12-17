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
            'duedate' => $this->faker->dateTimeBetween('+1 week', '+3 months'),
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

            // randomly assigned priority
            $priority = rand(1, 3);
            if ($priority === 1) {
                $ticket->priority = 'low';
            } elseif ($priority === 2) {
                $ticket->priority = 'medium';
            }
            // else $priority is 3 and doesn't change default priority (high)

            // randomly assigned status
            $status = rand(1, 4);
            if ($status === 1) {
                $ticket->status = 'completed';
            } elseif ($status === 2) {
                $ticket->status = 'submitted';
            } elseif ($status === 3) {
                $ticket->status = 'in_progress';
            }
            // else $status is 4 and doesn't change default status (assigned)

            // randomly assigned type
            $type = rand(1, 3);
            if ($type === 1) {
                $ticket->type = 'other';
            } elseif ($type === 2) {
                $ticket->type = 'feature';
            }
            // else $type is 3 and doesn't change default type (bug)
        })->afterCreating(function (Ticket $ticket) {
            $ticket->developer->notify(new ProjectAndTicketNotification(User::all()->first(), $ticket, 'Ticket', 'assign'));
        });
    }
}
