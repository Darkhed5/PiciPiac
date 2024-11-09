<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Rendelés mentése és véglegesítése
    public function store()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('status', 'A kosarad üres.');
        }

        // Összesített ár számítása
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Rendelés létrehozása
        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        // Rendelési tételek hozzáadása
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // Kosár ürítése
        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('home')->with('status', 'Rendelés sikeresen leadva!');
    }

    // Rendelési előzmények megtekintése
    public function history()
    {
        $orders = Order::where('user_id', Auth::id())->with('items.product')->orderBy('created_at', 'desc')->get();
        return view('orders.history', compact('orders'));
    }
}
