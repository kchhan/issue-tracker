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
    {}

    /**
     * Determine whether the user can view the ticket.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Ticket $ticket
     * @return mixed
     */
    public function view(User $user, Ticket $ticket)
    {}

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
        if ($user->can('edit own tickets')) {
            return $user->id === $ticket->developer->id;
        }

        if ($user->can('edit any tickets')) {
            return true;
        }
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
        return $user->can('delete tickets');

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
