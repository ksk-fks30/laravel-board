<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'thread_id',
        'number',
        'body',
        'posted_at',
        'ip_address'
    ];

    protected $dates = [
        'posted_at',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }
}
