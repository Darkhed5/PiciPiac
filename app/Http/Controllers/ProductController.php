<?php

namespace App\Http\Controllers;

use App\Models\Product; // Ezzel importáljuk a Product modellt
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Megjeleníti a termékkatalógust.
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
     * Megjeleníti az új termék hozzáadásának űrlapját.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Elmenti az újonnan hozzáadott terméket az adatbázisba.
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
}
