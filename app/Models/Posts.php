<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Posts extends Model
{
    protected $keyType = 'string';

    protected $fillable = [
        'title', 'content', 'userid', 'categoryid'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');    
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryid');    
    }

    protected static function booted()
    {
        static::creating(function ($post) {
            if (!$post->id) {
                $post->id = (string) Str::uuid();
            }
        });
    }
}
