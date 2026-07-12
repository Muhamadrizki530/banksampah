<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\User;

class AchievementController extends Controller
{
    /**
     * Cek dan berikan achievement ke user.
     */
    public function checkAchievements(User $user)
    {
        $achievements = Achievement::all();

        foreach ($achievements as $achievement) {

            $earned = false;

            switch ($achievement->type) {

                case 'point':
                    $earned = $user->total_point >= $achievement->target;
                    break;

                case 'transaction':
                    $earned = $user->wasteTransactions()->count() >= $achievement->target;
                    break;

                case 'weight':
                    $earned = $user->wasteTransactions()->sum('weight') >= $achievement->target;
                    break;
            }

            if ($earned) {
                $user->achievements()->syncWithoutDetaching([
                    $achievement->id => [
                        'earned_at' => now(),
                    ]
                ]);
            }
        }
    }
}