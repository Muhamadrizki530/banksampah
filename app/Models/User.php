<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\WasteTransaction;
use App\Models\Redemption;
use App\Models\Achievement;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    

    public function wasteTransactions()
{
    return $this->hasMany(WasteTransaction::class);
}

public function redemptions()
{
    return $this->hasMany(Redemption::class);
}

public function achievements()
{
    return $this->belongsToMany(Achievement::class);
}
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
}
