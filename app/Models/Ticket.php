<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'due_on',
    ];

    /**
     * Returns the manager of the tickets' project
     */
    public function manager()
    {
        return $this->project->manager;
    }

    /**
     * Return the assigned developer of the ticket
     */
    public function developer()
    {
        return $this->belongsTo(User::class, 'developer_id');
    }

    /**
     * Return the project that the ticket is a part of
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
