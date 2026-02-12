<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'code',
        'name',
        'category',
        'description',
        'cost',
        'price',
        'stock',
        'measurement_unit_id',
        'status',
    ];

    public function measurementUnit()
    {
        return $this->belongsTo(MeasurementUnit::class);
    }
}
