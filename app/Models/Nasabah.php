<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    protected $table = 'nasabah';

    protected $fillable = [
        'kode',
        'nama',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'email',
        'password',
        'poin',
    ];

    protected $hidden = [
        'password',
    ];
}