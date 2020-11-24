<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'manager_id',
        'title',
        'description',
        'developers',
        'due_on',

    ];

    /**
     * Returns the project manager of the project
     */
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    /**
     * Returns all assigned develpers of the project
     */
    public function developers()
    {
        return $this->belongsToMany(User::class, 'developer_project', 'project_id', 'developer_id')->withTimestamps();
    }

    /**
     * Return all tickets of the project
     */
    public function tickets()
    {
        return $this->belongsToMany(Ticket::class, 'developer_ticket')->withTimestamps();
    }
}
