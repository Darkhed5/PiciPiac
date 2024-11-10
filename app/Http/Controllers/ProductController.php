<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Termékkatalógus megjelenítése.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Szűrés kategória alapján
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        // Lekérdezzük a termékeket és átadjuk a nézetnek
        $products = $query->get();

        return view('products.index', compact('products'));
    }

    /**
     * Új termék hozzáadása űrlap megjelenítése.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Új termék mentése az adatbázisba.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'stock' => 'required|integer|min:0',
        ]);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'stock' => $request->stock,
        ]);

        return redirect('/products')->with('status', 'Termék sikeresen hozzáadva!');
    }

    /**
     * Termékszerkesztő űrlap megjelenítése.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * A szerkesztett termék mentése.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'stock' => $request->stock,
        ]);

        return redirect('/products')->with('status', 'Termék sikeresen frissítve!');
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    
        return redirect('/products')->with('status', 'Termék sikeresen törölve!');
    }    
}