<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use App\Models\WasteTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // =========================
        // Statistik Utama
        // =========================
        $totalTransaksi = WasteTransaction::where('user_id', $user->id)->count();

        $totalBerat = WasteTransaction::where('user_id', $user->id)->sum('weight');

        $totalPoin = WasteTransaction::where('user_id', $user->id)->sum('total_point');

        // =========================
        // Progress Rank
        // =========================
        $ranks = [
            ['name' => 'Pemula',    'min' => 0],
            ['name' => 'Aktif',     'min' => 500],
            ['name' => 'Peduli',    'min' => 2000],
            ['name' => 'Penggerak', 'min' => 5000],
            ['name' => 'Pelopor',   'min' => 10000],
        ];

        $currentPoint = $user->current_point;
        $rankSekarang = $user->rank;

        $rankProgressPercentage = 100;
        $rankBerikutnya = null;
        $poinMenujuRank = 0;

        foreach ($ranks as $index => $rank) {

            if ($rank['name'] == $rankSekarang) {

                if (isset($ranks[$index + 1])) {

                    $next = $ranks[$index + 1];

                    $range = $next['min'] - $rank['min'];

                    $progress = $currentPoint - $rank['min'];

                    $rankProgressPercentage = min(
                        100,
                        max(0, round(($progress / $range) * 100))
                    );

                    $rankBerikutnya = $next['name'];

                    $poinMenujuRank = max(0, $next['min'] - $currentPoint);
                }

                break;
            }
        }

        // =========================
        // Riwayat Ringkas
        // =========================
        $riwayatRingkas = WasteTransaction::with('wasteType')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return (object)[
                    'tanggal' => $item->created_at,
                    'jenis_sampah' => $item->wasteType->name ?? '-',
                    'berat' => $item->weight,
                    'poin' => $item->total_point,
                ];
            });

        // =========================
        // Grafik Bulanan
        // =========================
        $monthly = WasteTransaction::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->where('user_id', $user->id)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $namaBulan = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Agu',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des'
        ];

        $monthlyLabels = $monthly->map(function ($item) use ($namaBulan) {
            return $namaBulan[$item->bulan];
        });

        $monthlyData = $monthly->pluck('total');

        // =========================
        // Grafik Jenis Sampah
        // =========================
        $wasteType = WasteTransaction::join(
                'waste_types',
                'waste_transactions.waste_type_id',
                '=',
                'waste_types.id'
            )
            ->select(
                'waste_types.name',
                DB::raw('SUM(weight) as total')
            )
            ->where('user_id', $user->id)
            ->groupBy('waste_types.name')
            ->get();

        $wasteTypeLabels = $wasteType->pluck('name');

        $wasteTypeData = $wasteType->pluck('total');

        return view('nasabah.statistik', [

            'totalTransaksi' => $totalTransaksi,
            'totalBerat' => $totalBerat,
            'totalPoin' => $totalPoin,

            'rankSekarang' => $rankSekarang,
            'rankProgressPercentage' => $rankProgressPercentage,
            'rankBerikutnya' => $rankBerikutnya,
            'poinMenujuRank' => $poinMenujuRank,

            'riwayatRingkas' => $riwayatRingkas,

            'monthlyLabels' => $monthlyLabels,
            'monthlyData' => $monthlyData,

            'wasteTypeLabels' => $wasteTypeLabels,
            'wasteTypeData' => $wasteTypeData,
        ]);
    }
}