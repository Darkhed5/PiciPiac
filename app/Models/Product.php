<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * A kitölthető mezők listája.
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'user_id', // Az eladó azonosítója
        'image_path', // A termékkép elérési útja
        'stock', // Raktárkészlet
    ];

    /**
     * Kapcsolat a User modellel (az eladó adataihoz).
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Kapcsolat a rendelési tételekkel (ha szükséges).
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
