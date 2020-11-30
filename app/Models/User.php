<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable;

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
     * Return an array of users with the role of admin using spatie
     */
    public function getAdmins()
    {
        return User::role('admin')->get();
    }

    /**
     * Return an array of users with the role of manager using spatie
     */
    public function getManagers()
    {
        return User::role('manager')->get();
    }

    /**
     * Return an array of users with the role of developer using spatie
     */
    public function getDevelopers()
    {
        return User::role('developer')->get();
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
