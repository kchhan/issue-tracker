<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
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
     * Determine whether the user can view any project.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('view projects');
    }

    /**
     * Determine whether the user can view the project.
     *
     * @param  \App\User $user
     * @param  \App\Project $project
     * @return mixed
     */
    public function view(User $user, Project $project)
    {
        return $user->can('view projects', $project);
    }


    /**
     * Determine whether the user can create a project.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create projects');
    }

    /**
     * Determine if the given project can be updated by the user
     *
     * @param \App\Models\User $user
     * @param \App\Models\Project $project
     */
    public function update(User $user, Project $project)
    {
        if ($user->can('edit projects')) {
            return $user->id === $project->manager_id;
        }

        return $user->can('edit any tickets');
    }

    /**
     * Determine whether the user can delete the project.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Project  $project
     * @return mixed
     */
    public function delete(User $user, Project $project)
    {
        if ($user->can('delete projects')) {
            return $user->id == $project->manager_id;
        }

        return $user->can('delete any projects');
    }

    /**
     * Determine whether the user can restore the project.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Project  $project
     * @return mixed
     */
    public function restore(User $user, Project $project)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the project.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Project  $project
     * @return mixed
     */
    public function forceDelete(User $user, Project $project)
    {
        //
    }
}
