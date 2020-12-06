<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'developer_id',
        'title',
        'description',
        'type',
        'status',
        'priority',
        'duedate',
    ];

    /**
     * Formats the date before sending it to views
     * Exception: edit views need a different format for datetime-local input field
     * @param date
     */
    public function getDuedateAttribute($value)
    {
        return Carbon::createFromTimestamp($value)->timezone('America/Los_Angeles');
    }

    /**
     * Formats the date before sending it to views
     * @param date
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromTimestamp($value)->timezone('America/Los_Angeles');
    }

    /**
     * Formats the date before sending it to views
     * @param date
     */
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::createFromTimestamp($value)->timezone('America/Los_Angeles');
    }


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
