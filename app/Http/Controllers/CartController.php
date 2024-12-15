<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        return view('cart.index', compact('cartItems'));
    }

    public function add(Request $request, $productId)
    {
        $cartItem = Cart::firstOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $productId],
            ['quantity' => 0]
        );
        
        $cartItem->quantity += $request->input('quantity', 1);
        $cartItem->save();

        return redirect()->route('cart.index')->with('status', 'Termék hozzáadva a kosárhoz!');
    }

    public function update(Request $request, $cartId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::findOrFail($cartId);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect()->route('cart.index')->with('status', 'Darabszám sikeresen frissítve!');
    }

    public function remove($cartId)
    {
        $cartItem = Cart::findOrFail($cartId);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('status', 'Termék eltávolítva a kosárból!');
    }

    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        return view('cart.checkout', compact('cartItems'));
    }
}