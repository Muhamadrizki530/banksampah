<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grocery extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'point_price',
        'stock',
        'status',
    ];

    public function redemptions()
    {
        return $this->hasMany(Redemption::class);
    }
}