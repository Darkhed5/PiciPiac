<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];

    // Kapcsolat a rendelési tételekkel (OrderItem modell)
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Kapcsolat a felhasználóval (User modell)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
