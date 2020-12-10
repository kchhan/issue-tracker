<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
     * Hashes the password before storing
     * @param string $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Returns users full name
     */
    public function name()
    {
        return $this->first_name . " " . $this->last_name;
    }

    /**
     * Return all projects that the user is a part of
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'developer_project', 'developer_id', 'project_id');
    }

    /**
     * Returns all tickets that the user is assigned to
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'developer_id');
    }

    /**
     * Return the path to the user's profile
     */
    public function path($append = '')
    {
        $path = route('profile', $this->username);

        return $append ? "{$path}/{$append}" : $path;
    }

    /**
     * Return the avatar path
     */
    public function getAvatarAttribute($value)
    {
        return asset($value ?: '/images/default-avatar.jpeg');
    }
}
