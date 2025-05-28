<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'ingredients',
        'instructions',
        'image_url',
        'user_id',
        'category',
    ];

    protected $casts = [
        'ingredients' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function isLikedByUser(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }
    public function scopePopular($query)
{
    return $query->withCount('likes')
                 ->orderBy('likes_count', 'desc');
}

public function scopeRecent($query)
{
    return $query->orderBy('created_at', 'desc');
}
}