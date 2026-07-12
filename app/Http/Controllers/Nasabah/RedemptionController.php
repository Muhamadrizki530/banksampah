<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use App\Models\Grocery;
use App\Models\Redemption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RedemptionController extends Controller
{
    /**
     * Halaman Tukar Poin
     */
    public function index()
    {
        $groceries = Grocery::where('status', 1)
            ->where('stock', '>', 0)
            ->latest()
            ->get();

        return view('nasabah.redemptions.index', compact('groceries'));
    }

    /**
     * Proses Tukar Poin (Beli langsung, 1 item)
     */
    public function store(Request $request)
    {
        $request->validate([
            'grocery_id' => 'required|exists:groceries,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $grocery = Grocery::findOrFail($request->grocery_id);

        $pointUsed = $grocery->point_price * $request->quantity;

        // Cek poin
        if ($user->current_point < $pointUsed) {
            return back()->with('error', 'Poin Anda tidak mencukupi.');
        }

        // Cek stok
        if ($grocery->stock < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        $redemption = DB::transaction(function () use ($user, $grocery, $request, $pointUsed) {
            $pointBefore = $user->current_point;
            $pointAfter  = $pointBefore - $pointUsed;

            $redemption = Redemption::create([
                'user_id'      => $user->id,
                'grocery_id'   => $grocery->id,
                'quantity'     => $request->quantity,
                'point_used'   => $pointUsed,
                'point_before' => $pointBefore,
                'point_after'  => $pointAfter,
                'status'       => 'success',
            ]);

            $user->current_point = $pointAfter;
            $user->save();

            $grocery->decrement('stock', $request->quantity);

            return $redemption;
        });

        return redirect()
            ->route('nasabah.redemptions.show', $redemption)
            ->with('success', 'Penukaran berhasil dilakukan.');
    }

    /**
     * Proses Tukar Poin dari Keranjang (banyak item sekaligus)
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'items'                => 'required|array|min:1',
            'items.*.grocery_id'   => 'required|exists:groceries,id',
            'items.*.quantity'     => 'required|integer|min:1',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $items = $request->input('items');

        // Ambil semua grocery yang dibutuhkan sekaligus (hindari N+1 query)
        $groceryIds = collect($items)->pluck('grocery_id');
        $groceries  = Grocery::whereIn('id', $groceryIds)->get()->keyBy('id');

        $totalPointUsed = 0;

        // Validasi stok & hitung total poin dulu, sebelum ada perubahan apapun
        foreach ($items as $item) {
            $grocery = $groceries->get($item['grocery_id']);

            if (!$grocery) {
                return back()->with('error', 'Salah satu item tidak ditemukan.');
            }

            if ($grocery->stock < $item['quantity']) {
                return back()->with('error', "Stok {$grocery->name} tidak mencukupi.");
            }

            $totalPointUsed += $grocery->point_price * $item['quantity'];
        }

        if ($user->current_point < $totalPointUsed) {
            return back()->with('error', 'Poin Anda tidak mencukupi untuk semua item di keranjang.');
        }

        $lastRedemption = null;

        DB::transaction(function () use ($user, $items, $groceries, &$lastRedemption) {

            foreach ($items as $item) {
                $grocery   = $groceries->get($item['grocery_id']);
                $quantity  = (int) $item['quantity'];
                $pointUsed = $grocery->point_price * $quantity;

                $pointBefore = $user->current_point;
                $pointAfter  = $pointBefore - $pointUsed;

                $lastRedemption = Redemption::create([
                    'user_id'      => $user->id,
                    'grocery_id'   => $grocery->id,
                    'quantity'     => $quantity,
                    'point_used'   => $pointUsed,
                    'point_before' => $pointBefore,
                    'point_after'  => $pointAfter,
                    'status'       => 'success',
                ]);

                $user->current_point = $pointAfter;
                $user->save();

                $grocery->decrement('stock', $quantity);
            }
        });

        return redirect()
            ->route('nasabah.redemptions.show', $lastRedemption)
            ->with('success', 'Semua item di keranjang berhasil ditukar.');
    }

    /**
     * Halaman Riwayat Penukaran
     */
    public function history()
    {
        $redemptions = Redemption::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('nasabah.redemptions.history', compact('redemptions'));
    }

    /**
     * Halaman Detail Penukaran
     */
    public function show(Redemption $redemption)
    {
        if ($redemption->user_id !== Auth::id()) {
            abort(403);
        }

        return view('nasabah.redemptions.show', compact('redemption'));
    }
}