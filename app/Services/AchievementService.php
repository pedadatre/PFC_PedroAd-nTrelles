<?php

namespace App\Services;

use App\Models\User;
use App\Models\Achievement;
use Illuminate\Support\Facades\DB;

class AchievementService
{
    public function checkUserAchievements(User $user)
    {
        $this->checkRecipesCreated($user);
        $this->checkLikesReceived($user);
        $this->checkCommentsMade($user);
    }

    private function checkRecipesCreated(User $user)
    {
        $recipesCount = $user->recipes()->count();
        $this->updateAchievements($user, 'recipes_created', $recipesCount);
    }

    private function checkLikesReceived(User $user)
    {
        $likesCount = $user->recipes()->withCount('likes')
                          ->get()
                          ->max('likes_count');
        $this->updateAchievements($user, 'likes_received', $likesCount);
    }

    private function checkCommentsMade(User $user)
    {
        $commentsCount = $user->comments()->count();
        $this->updateAchievements($user, 'comments_made', $commentsCount);
    }

    private function updateAchievements(User $user, string $type, int $count)
    {
        $achievements = Achievement::where('type', $type)
                                 ->where('requirement_count', '<=', $count)
                                 ->get();
    
        foreach ($achievements as $achievement) {
            $userAchievement = $user->achievements()
                                   ->where('achievement_id', $achievement->id)
                                   ->first();
    
            if (!$userAchievement) {
                DB::transaction(function () use ($user, $achievement, $count) {
                    // Otorgar el logro
                    $user->achievements()->attach($achievement->id, [
                        'progress' => $count,
                        'unlocked_at' => now()
                    ]);
    
                    // Otorgar recompensa
                    $user->increment('coins', $achievement->coins_reward);
    
                    // Crear notificación usando el sistema de notificaciones de Laravel
                    $user->notify(new \App\Notifications\AchievementUnlocked($achievement));
                });
            
        
    
            } else {
                // Actualizar progreso si no está desbloqueado
                if (!$userAchievement->pivot->unlocked_at) {
                    $user->achievements()
                         ->updateExistingPivot($achievement->id, ['progress' => $count]);
                }
            }
        }
    }
}