<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'description',
        'icon',
        'price',
        'type'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_items')
                    ->withTimestamps();
    }
}