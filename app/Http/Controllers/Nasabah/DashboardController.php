<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\WasteTransaction;
use App\Models\Redemption;
use App\Models\Achievement;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Statistik Utama
        |--------------------------------------------------------------------------
        */

        $totalTransactions = WasteTransaction::where('user_id', $user->id)->count();

        $totalRedeems = Redemption::where('user_id', $user->id)->count();

        $totalWeight = WasteTransaction::where('user_id', $user->id)
            ->sum('weight');

        $currentPoint = $user->current_point ?? 0;
        $rank = $user->rank;

        /*
        |--------------------------------------------------------------------------
        | Rank System
        |--------------------------------------------------------------------------
        */

        $ranks = [
            ['name' => 'Pemula',    'min' => 0],
            ['name' => 'Aktif',     'min' => 500],
            ['name' => 'Peduli',    'min' => 2000],
            ['name' => 'Penggerak', 'min' => 5000],
            ['name' => 'Pelopor',   'min' => 10000],
        ];

        $nextRank = null;
        $pointsToNextRank = 0;
        $rankProgress = 100;

        foreach ($ranks as $index => $rank) {

            if ($currentPoint >= $rank['min']) {

                if (isset($ranks[$index + 1])) {

                    $next = $ranks[$index + 1];

                    $nextRank = $next['name'];

                    $pointsToNextRank = max(
                        0,
                        $next['min'] - $currentPoint
                    );

                    $currentMin = $rank['min'];
                    $nextMin = $next['min'];

                    $rankProgress = min(
                        100,
                        (($currentPoint - $currentMin) / ($nextMin - $currentMin)) * 100
                    );
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Pengumuman
        |--------------------------------------------------------------------------
        */

        $announcements = collect([
            [
                'icon' => 'bi-stars',
                'text' => 'Selamat datang di Bank Sampah! Terus tingkatkan poin Anda.',
                'variant' => 'success',
            ],
            [
                'icon' => 'bi-recycle',
                'text' => 'Setor sampah plastik minggu ini untuk mendapatkan bonus poin.',
                'variant' => 'info',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Aktivitas Terbaru
        |--------------------------------------------------------------------------
        */

        $depositActivities = WasteTransaction::with('wasteType')
            ->where('user_id', $user->id)
            ->latest()
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'setor',
                    'title' => $item->wasteType?->name ?? 'Sampah',
                    'subtitle' => $item->weight . ' Kg',
                    'point' => $item->total_point,
                    'date' => $item->created_at,
                ];
            });

        $redeemActivities = Redemption::with('grocery')
            ->where('user_id', $user->id)
            ->latest()
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'tukar',
                    'title' => $item->grocery?->name ?? 'Penukaran',
                    'subtitle' => $item->quantity . ' item',
                    'point' => -$item->point_used,
                    'date' => $item->created_at,
                ];
            });

        $activities = $depositActivities
            ->concat($redeemActivities)
            ->sortByDesc('date')
            ->take(5)
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Achievement
        |--------------------------------------------------------------------------
        */

        $achievements = $user->achievements()->get();

        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */

        return view('nasabah.dashboard', compact(
            'totalTransactions',
            'totalRedeems',
            'totalWeight',
            'rank',
            'nextRank',
            'pointsToNextRank',
            'rankProgress',
            'announcements',
            'activities',
            'achievements'
        ));
    }
}
