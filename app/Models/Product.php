<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'category',
        'description',
        'image',
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

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function hasStock(int $quantity): bool
    {
        return $this->stock >= $quantity;
    }
}
