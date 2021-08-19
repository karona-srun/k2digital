<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'post', 
        'likes',
        'privacy',
        'creator',
        'updator'
    ]; 

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'created_at' => 'datetime:D,d m Y H:i A',
    //     'updated_at' => 'datetime:D,d m Y H:i A'
    // ];
    /**
     * Get the comments for the blog post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function creator()
    {
        return $this->belongsTo('App\Models\User','creator');
    }

    public function updator()
    {
        return $this->belongsTo('App\Models\User','updator');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('D,d m Y H:i A');
    }

}
