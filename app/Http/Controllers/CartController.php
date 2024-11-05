<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Kosár tartalmának megjelenítése
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('cart.index', compact('cartItems'));
    }

    // Termék hozzáadása a kosárhoz
    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $productId)->first();
        
        if ($cartItem) {
            // Ha a termék már a kosárban van, növeljük a mennyiséget
            $cartItem->quantity += $request->input('quantity', 1);
            $cartItem->save();
        } else {
            // Új termék hozzáadása a kosárhoz
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => $request->input('quantity', 1),
            ]);
        }

        return redirect()->route('cart.index')->with('status', 'Termék sikeresen hozzáadva a kosárhoz!');
    }

    // Termék eltávolítása a kosárból
    public function remove($cartId)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('id', $cartId)->firstOrFail();
        $cartItem->delete();

        return redirect()->route('cart.index')->with('status', 'Termék eltávolítva a kosárból!');
    }
}
