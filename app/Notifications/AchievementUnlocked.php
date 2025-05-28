<?php

namespace App\Notifications;

use App\Models\Achievement;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class AchievementUnlocked extends Notification
{
    use Queueable;

    protected $achievement;

    public function __construct(Achievement $achievement)
    {
        $this->id = Str::uuid();
        $this->achievement = $achievement;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'achievement_name' => $this->achievement->name,
            'coins_reward' => $this->achievement->coins_reward
        ];
    }
}