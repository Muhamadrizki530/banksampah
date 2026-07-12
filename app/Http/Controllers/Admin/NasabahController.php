<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NasabahController extends Controller
{
    public function index()
    {
        $nasabah = User::where('role', 'nasabah')
            ->latest()
            ->get();

        return view('admin.nasabah.index', compact('nasabah'));
    }

    public function create()
    {
        return view('admin.nasabah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'            => 'required|string|max:255',
            'jenis_kelamin'   => 'required|in:Laki-laki,Perempuan',
            'email'           => 'required|email|unique:users,email',
            'no_hp'           => 'required|string|max:20',
            'alamat'          => 'required|string',
        ]);

        User::create([
            'name'            => $request->nama,
            'email'           => $request->email,
            'password'        => Hash::make('123456'),
            'phone'           => $request->no_hp,
            'address'         => $request->alamat,
            'jenis_kelamin'   => $request->jenis_kelamin,
            'role'            => 'nasabah',
            'status'          => true,
            'rank'            => 'Bronze',
            'current_point'   => 0,
            'total_point'     => 0,
        ]);

        return redirect()->route('admin.nasabah.index')
            ->with('success', 'Nasabah berhasil ditambahkan.');
    }

    public function show($id)
    {
        $nasabah = User::where('role', 'nasabah')->findOrFail($id);

        return view('admin.nasabah.show', compact('nasabah'));
    }

    public function edit($id)
    {
        $nasabah = User::where('role', 'nasabah')->findOrFail($id);

        return view('admin.nasabah.edit', compact('nasabah'));
    }

    public function update(Request $request, $id)
    {
        $nasabah = User::where('role', 'nasabah')->findOrFail($id);

        $request->validate([
            'nama'            => 'required|string|max:255',
            'jenis_kelamin'   => 'required|in:Laki-laki,Perempuan',
            'email'           => 'required|email|unique:users,email,' . $id,
            'no_hp'           => 'required|string|max:20',
            'alamat'          => 'required|string',
        ]);

        $nasabah->update([
            'name'            => $request->nama,
            'email'           => $request->email,
            'phone'           => $request->no_hp,
            'address'         => $request->alamat,
            'jenis_kelamin'   => $request->jenis_kelamin,
        ]);

        return redirect()->route('admin.nasabah.index')
            ->with('success', 'Data berhasil diubah.');
    }

    public function destroy($id)
    {
        $nasabah = User::where('role', 'nasabah')->findOrFail($id);

        $nasabah->delete();

        return redirect()->route('admin.nasabah.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}