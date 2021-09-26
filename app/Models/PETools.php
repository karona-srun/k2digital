<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class PETools extends Model
{
    use HasFactory;

    protected $fillable = [
        'fb_id',
        'fb_name',
        'fb_link',
        'fb_picture',
        'fb_access_token',
        'created_by',
        'updated_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function updator()
    {
        return $this->belongsTo(User::class,'updated_by');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('D,d m Y H:i A');
    }
}
