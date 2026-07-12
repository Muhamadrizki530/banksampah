<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grocery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GroceryController extends Controller
{
    public function index()
    {
        $groceries = Grocery::latest()->get();

        return view('admin.groceries.index', compact('groceries'));
    }

    public function create()
    {
        return view('admin.groceries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable',
            'point_price' => 'required|integer|min:1',
            'stock' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);

        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('groceries', 'public');
        }

        Grocery::create([
            'name' => $request->name,
            'image' => $image,
            'description' => $request->description,
            'point_price' => $request->point_price,
            'stock' => $request->stock,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.groceries.index')
            ->with('success', 'Hadiah berhasil ditambahkan.');
    }

    public function show(Grocery $grocery)
    {
        return view('admin.groceries.show', compact('grocery'));
    }

    public function edit(Grocery $grocery)
    {
        return view('admin.groceries.edit', compact('grocery'));
    }

    public function update(Request $request, Grocery $grocery)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable',
            'point_price' => 'required|integer|min:1',
            'stock' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {

            if ($grocery->image && Storage::disk('public')->exists($grocery->image)) {
                Storage::disk('public')->delete($grocery->image);
            }

            $grocery->image = $request->file('image')->store('groceries', 'public');
        }

        $grocery->name = $request->name;
        $grocery->description = $request->description;
        $grocery->point_price = $request->point_price;
        $grocery->stock = $request->stock;
        $grocery->status = $request->status;

        $grocery->save();

        return redirect()
            ->route('admin.groceries.index')
            ->with('success', 'Hadiah berhasil diperbarui.');
    }

    public function destroy(Grocery $grocery)
    {
        if ($grocery->image && Storage::disk('public')->exists($grocery->image)) {
            Storage::disk('public')->delete($grocery->image);
        }

        $grocery->delete();

        return redirect()
            ->route('admin.groceries.index')
            ->with('success', 'Hadiah berhasil dihapus.');
    }
}