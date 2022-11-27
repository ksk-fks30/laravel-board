<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Thread extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title'
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * タイトルの省略したテキストを返す
     *
     * @return string
     */
    public function getShortTitleAttribute(): string
    {
        return Str::limit($this->title, config('const.thread.title_short_length'));
    }
}
