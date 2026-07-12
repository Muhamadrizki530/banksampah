<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Menampilkan halaman register.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Menyimpan data registrasi.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone'     => ['required', 'string', 'max:20'],
            'address'   => ['required', 'string'],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name'          => $request->name,
            'email'         => strtolower($request->email),
            'phone'         => $request->phone,
            'address'       => $request->address,
            'password'      => Hash::make($request->password),

            // Default akun baru
            'role'          => 'nasabah',
            'status'        => 1,
            'current_point' => 0,
            'total_point'   => 0,
        ]);

        return redirect()->route('login')->with(
            'success',
            'Pendaftaran berhasil. Silakan login.'
        );
    }
}