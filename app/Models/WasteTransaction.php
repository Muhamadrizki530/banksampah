<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WasteTransaction extends Model
{
    protected $fillable = [
    'batch_number',
    'user_id',
    'waste_type_id',
    'weight',
    'total_point',
    'point_before',
    'point_after',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wasteType()
    {
        return $this->belongsTo(WasteType::class);
    }
}