<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'user_id',
        'image_path',
        'stock', // Hozzáadva a raktárkészlet kezelése miatt
    ];

    /**
     * Kapcsolat a User modellel.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Kapcsolat a rendelési tételekkel (ha szükséges).
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
