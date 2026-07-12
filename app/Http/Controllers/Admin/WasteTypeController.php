<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WasteType;
use Illuminate\Http\Request;

class WasteTypeController extends Controller
{
    public function index()
    {
        $wasteTypes = WasteType::latest()->get();

        return view('admin.waste-types.index', compact('wasteTypes'));
    }

    public function create()
    {
        return view('admin.waste-types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'point_per_kg' => 'required|integer|min:1',
            'status' => 'required|in:0,1',
        ]);

        WasteType::create($validated);

        return redirect()
            ->route('admin.waste-types.index')
            ->with('success', 'Jenis sampah berhasil ditambahkan.');
    }

    public function show(WasteType $wasteType)
    {
        return redirect()->route('admin.waste-types.index');
    }

    public function edit(WasteType $wasteType)
    {
        return view('admin.waste-types.edit', compact('wasteType'));
    }

    public function update(Request $request, WasteType $wasteType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'point_per_kg' => 'required|integer|min:1',
            'status' => 'required|in:0,1',
        ]);

        $wasteType->update($validated);

        return redirect()
            ->route('admin.waste-types.index')
            ->with('success', 'Jenis sampah berhasil diperbarui.');
    }

    public function destroy(WasteType $wasteType)
    {
        $wasteType->delete();

        return redirect()
            ->route('admin.waste-types.index')
            ->with('success', 'Jenis sampah berhasil dihapus.');
    }
}