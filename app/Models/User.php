<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'avatar',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Returns users full name
     */
    public function name()
    {
        return $this->first_name . " " . $this->last_name;
    }

    /**
     * Returns the role types of the user
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * Saves the user to a specific role type
     * @var string
     * $role->allowTo('edit_page')
     */
    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::whereName($role)->firstOrFail();
        }
        // create a new role_user pivot table instance but do not drop the others
        $this->roles()->sync($role, false);
    }

    /**
     * Returns list of user's permissions
     */
    public function permissions()
    {
        return $this->roles->map->permissions->flatten()->pluck('name')->unique();
    }

    /**
     * Return an array of users with the role of developer
     */
    public function getDevelopers()
    {
        // TODO get all developers
    }

    /**
     * Return all projects that the user is a part of
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Returns all tickets that the user is assigned to
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'developer_ticket');
    }

    /**
     * Return the path to the user's profile
     */
    public function path($append = '')
    {
        $path = route('profile', $this->username);

        return $append ? "{$path}/{$append}" : $path;
    }
}
