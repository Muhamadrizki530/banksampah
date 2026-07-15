<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'jenis_kelamin',
        'role',
        'status',
        'rank',
        'current_point',
        'total_point',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke transaksi sampah.
     */
    public function wasteTransactions()
    {
        return $this->hasMany(WasteTransaction::class);
    }

    /**
     * Relasi ke penukaran.
     */
    public function redemptions()
    {
        return $this->hasMany(Redemption::class);
    }

    /**
     * Relasi ke achievement.
     */
    public function achievements()
    {
        return $this->belongsToMany(Achievement::class);
    }
}