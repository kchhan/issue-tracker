<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can view any ticket.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('view tickets');
    }

    /**
     * Determine whether the user can view the ticket.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Ticket $ticket
     * @return mixed
     */
    public function view(User $user, Ticket $ticket)
    {
        return $user->can('view tickets', $ticket);
    }

    /**
     * Determine whether the user can create a ticket.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create tickets');
    }

    /**
     * Determine whether the user can update the ticket.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Ticket $ticket
     * @return mixed
     */
    public function update(User $user, Ticket $ticket)
    {
        if ($user->can('edit tickets')) {
            if ($user->id === $ticket->developer->id) {
                return true;
            } elseif ($user->id === $ticket->project->manager_id) {
                return true;
            }
        }

        return $user->can('edit any tickets');
    }

    /**
     * Determine whether the user can delete the ticket.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ticket  $ticket
     * @return mixed
     */
    public function delete(User $user, Ticket $ticket)
    {
        if ($user->can('delete tickets')) {
            return $user->id === $ticket->project->manager_id;
        }

        return $user->can('delete any tickets');
    }

    /**
     * Determine whether the user can restore the ticket.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Ticket $ticket
     * @return mixed
     */
    public function restore(User $user, Ticket $ticket)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the ticket.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Ticket $ticket
     * @return mixed
     */
    public function forceDelete(User $user, Ticket $ticket)
    {
        //
    }
}
