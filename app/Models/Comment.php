<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id', 
        'comments',
        'creator',
        'updator'
    ]; 

    /**
     * Get the post that owns the comment.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
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
