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
        'title',
        'description',
    ];

    /**
     * Returns the project manager of the project
     */
    public function manager()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns all assigned develpers of the project
     */
    public function developers()
    {
        return $this->hasMany(User::class);
    }
}
