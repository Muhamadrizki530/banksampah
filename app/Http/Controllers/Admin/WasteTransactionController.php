<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WasteType;
use App\Models\WasteTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class WasteTransactionController extends Controller
{
    /**
     * Menampilkan daftar transaksi
     */
    public function index()
    {
        $transactions = WasteTransaction::with(['user', 'wasteType'])
            ->latest()
            ->get()
            ->groupBy(function ($transaction) {
                return $transaction->batch_number ?: 'single-' . $transaction->id;
            });

        return view('admin.waste-transactions.index', compact('transactions'));
    }

    /**
     * Form tambah transaksi
     */
    public function create()
    {
        $users = User::where('role', 'nasabah')->get();
        $wasteTypes = WasteType::all();

        return view('admin.waste-transactions.create', compact('users', 'wasteTypes'));
    }

    /**
     * Simpan transaksi
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'items' => 'required|array|min:1',
            'items.*.waste_type_id' => 'required|exists:waste_types,id',
            'items.*.weight' => 'required|numeric|min:0.01',
        ]);

        $user = User::findOrFail($request->user_id);

        $runningPoint = $user->current_point;

        $batchNumber = (string) Str::uuid();
        $totalPoint = 0;
        $firstTransaction = null;

        foreach ($request->items as $item) {

            $wasteType = WasteType::findOrFail($item['waste_type_id']);

            $point = $item['weight'] * $wasteType->point_per_kg;

            $before = $runningPoint;
            $after = $before + $point;

            $transaction = WasteTransaction::create([
                'batch_number'  => $batchNumber,
                'user_id'       => $request->user_id,
                'waste_type_id' => $item['waste_type_id'],
                'weight'        => $item['weight'],
                'total_point'   => $point,
                'point_before'  => $before,
                'point_after'   => $after,
            ]);

            $runningPoint = $after;
            $totalPoint += $point;

            if (!$firstTransaction) {
                $firstTransaction = $transaction;
            }
        }

        // Update poin user
        $user->current_point = $runningPoint;
        $user->total_point += $totalPoint;

        // Update rank
        if ($user->total_point >= 10000) {
            $user->rank = 'Pelopor';
        } elseif ($user->total_point >= 5000) {
            $user->rank = 'Penggerak';
        } elseif ($user->total_point >= 2000) {
            $user->rank = 'Peduli';
        } elseif ($user->total_point >= 500) {
            $user->rank = 'Aktif';
        } else {
            $user->rank = 'Pemula';
        }

        $user->save();

        return redirect()
            ->route('admin.waste-transactions.receipt', $firstTransaction)
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    /**
     * Detail transaksi
     */
    public function show(WasteTransaction $wasteTransaction)
    {
        return view('admin.waste-transactions.show', compact('wasteTransaction'));
    }

    /**
     * Cetak Struk
     */
    public function receipt(WasteTransaction $wasteTransaction)
    {
        if ($wasteTransaction->batch_number) {
            $batchItems = WasteTransaction::with('wasteType')
                ->where('batch_number', $wasteTransaction->batch_number)
                ->get();
        } else {
            $wasteTransaction->load('wasteType');
            $batchItems = collect([$wasteTransaction]);
        }

        $wasteTransaction->load('user');
        $totalPoint = $batchItems->sum('total_point');

        return view(
            'admin.waste-transactions.receipt',
            compact('wasteTransaction', 'batchItems', 'totalPoint')
        );
    }

    /**
     * Download PDF
     */
    public function downloadPdf(WasteTransaction $wasteTransaction)
    {
        if ($wasteTransaction->batch_number) {
            $batchItems = WasteTransaction::with('wasteType')
                ->where('batch_number', $wasteTransaction->batch_number)
                ->get();
        } else {
            $wasteTransaction->load('wasteType');
            $batchItems = collect([$wasteTransaction]);
        }

        $wasteTransaction->load('user');
        $totalPoint = $batchItems->sum('total_point');

        $pdf = Pdf::loadView(
            'admin.waste-transactions.receipt-pdf',
            compact('wasteTransaction', 'batchItems', 'totalPoint')
        );

        return $pdf->download('TRX-' . $wasteTransaction->id . '.pdf');
    }

    /**
     * Form edit
     */
    public function edit(WasteTransaction $wasteTransaction)
    {
        $users = User::where('role', 'nasabah')->get();
        $wasteTypes = WasteType::all();

        return view('admin.waste-transactions.edit', compact(
            'wasteTransaction',
            'users',
            'wasteTypes'
        ));
    }

    public function update(Request $request, WasteTransaction $wasteTransaction)
    {
        //
    }

    /**
     * Hapus transaksi
     */
    public function destroy(WasteTransaction $wasteTransaction)
    {
        $wasteTransaction->delete();

        return back()->with('success', 'Transaksi berhasil dihapus.');
    }
}
