<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderStatusUpdated;
use App\Notifications\OrderPlaced;

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

        $user = Auth::user();
        $user->notify(new OrderPlaced($order));

        return redirect()->route('order.history')->with('status', 'Rendelés sikeresen leadva!');
    }

    public function history()
    {
        // Általam leadott rendelések
        $myOrders = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->orderBy('created_at', 'desc')
            ->get();
    
        // Tőlem rendelt termékek
        $ordersToMe = Order::whereHas('items.product', function ($query) {
            $query->where('user_id', Auth::id());
        })->with('items.product')
          ->orderBy('created_at', 'desc')
          ->get();
    
        // Kategóriánkénti termékek száma
        $categoryCounts = Product::select('category', \DB::raw('COUNT(*) as count'))
            ->groupBy('category')
            ->pluck('count', 'category');
    
        return view('orders.history', compact('myOrders', 'ordersToMe', 'categoryCounts'));
    }
    

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $order = Order::findOrFail($id);

        // Ellenőrizze, hogy te vagy-e a termék eladója
        $isSeller = $order->items->contains(function ($item) {
            return $item->product->user_id === Auth::id();
        });

        // Csak akkor engedélyezze a státusz frissítését, ha az order-hez tartozik olyan termék, amit te árulsz
        if ($order->user_id !== Auth::id() && !$isSeller) {
            return redirect()->back()->with('error', 'Nincs jogosultságod frissíteni ezt a rendelést.');
        }

        $order->status = $request->status;
        $order->save();

        $order->user->notify(new OrderStatusUpdated($order));

        return redirect()->back()->with('status', 'Rendelési státusz frissítve!');
    }

    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())
                      ->with('items.product')
                      ->findOrFail($id);

        return view('orders.show', compact('order'));
    }
}
