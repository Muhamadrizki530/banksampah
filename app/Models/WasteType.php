<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteType extends Model
{
    use HasFactory;

    protected $table = 'waste_types';

   protected $fillable = [
    'name',
    'category',
    'point_per_kg',
    'status',
    'point before',
    'point after',
];

    protected $casts = [
        'status' => 'boolean',
    ];
}