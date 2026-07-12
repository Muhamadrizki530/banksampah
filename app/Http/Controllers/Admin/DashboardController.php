<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WasteType;
use App\Models\WasteTransaction;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik
        $totalUsers = User::where('role', 'nasabah')->count();

        $totalWasteTypes = WasteType::count();

        $totalTransactions = WasteTransaction::count();

        $totalPoints = User::where('role', 'nasabah')->sum('current_point');

        // Aktivitas terbaru
        $recentTransactions = WasteTransaction::with(['user', 'wasteType'])
            ->latest()
            ->take(8)
            ->get();

        // Top nasabah
        $topUsers = User::where('role', 'nasabah')
            ->orderByDesc('current_point')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalWasteTypes',
            'totalTransactions',
            'totalPoints',
            'recentTransactions',
            'topUsers'
        ));
    }
}