<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Redemption;

class RedemptionController extends Controller
{
    /**
     * Menampilkan riwayat penukaran hadiah.
     */
    public function index()
    {
        $redemptions = Redemption::with(['user', 'grocery'])
            ->latest()
            ->get();

        return view('admin.redemptions.index', compact('redemptions'));
    }
}