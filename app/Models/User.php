<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Recipe;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Item;
use App\Models\Achievement;
use App\Models\Message;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_url',
        'coins_balance',
        'profile_frame',
        'title'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function achievements()
{
    return $this->belongsToMany(Achievement::class, 'user_achievements')
                ->withTimestamps()
                ->withPivot(['progress', 'unlocked_at']);
}

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);

    }
    public function items()
{
    return $this->belongsToMany(Item::class, 'user_items')
                ->withTimestamps();
}

public function activeAvatar()
{
    return $this->belongsTo(Item::class, 'active_avatar_id');
}

public function activeBadge()
{
    return $this->belongsTo(Item::class, 'active_badge_id');
}
public function sentMessages()
{
    return $this->hasMany(Message::class, 'sender_id');
}

public function receivedMessages()
{
    return $this->hasMany(Message::class, 'receiver_id');
}

}