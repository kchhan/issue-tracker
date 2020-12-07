<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
        return Carbon::createFromDate($value)->timezone('America/Los_Angeles');
    }

    /**
     * Formats the date before sending it to views
     * @param date
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromDate($value)->timezone('America/Los_Angeles');
    }

    /**
     * Formats the Timestamp before sending it to views
     * @param date
     */
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::createFromDate($value)->timezone('America/Los_Angeles');
    }

    /**
     * Defines relationship mangager_project
     */
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    /**
     * Defines relationship developer_project
     */
    public function developers()
    {
        // $this->belongsToMany(model, relationship_table, foreign_key, foreign_key name of the model joining to)
        return $this->belongsToMany(User::class, 'developer_project', 'project_id', 'developer_id')->withTimestamps();
    }

    /**
     * Defines relationship developer_ticket
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
