<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderStatusUpdated;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $order = new Order();
        $order->user_id = Auth::id();
        $order->status = 'feldolgozás alatt';
        $order->total_price = 0;
        $order->notes = $request->notes;
        $order->save();

        $totalPrice = 0;
        foreach ($request->items as $item) {
            $product = Product::findOrFail($item['product_id']);
            $price = $product->price * $item['quantity'];

            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $product->id;
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $product->price;
            $orderItem->save();

            $totalPrice += $price;
        }

        $order->total_price = $totalPrice;
        $order->save();

        return redirect()->route('order.history')->with('status', 'Rendelés sikeresen leadva!');
    }

    public function history()
    {
        $orders = Order::where('user_id', Auth::id())->with('items.product')->orderBy('created_at', 'desc')->get();

        return view('orders.history', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        $order->user->notify(new OrderStatusUpdated($order));

        return redirect()->back()->with('status', 'Rendelési státusz frissítve!');
    }
}
