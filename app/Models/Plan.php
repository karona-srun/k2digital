<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'plans',
        'description',
        'price',
        'duration'
    ];

    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_plans');
    }
}
