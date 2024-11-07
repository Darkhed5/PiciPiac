<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    // Kapcsolat a rendelésekkel (Order modell)
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Kapcsolat a termékekkel (Product modell)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
