<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // Termékek listázása
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $category = $request->input('category', '');
        $minPrice = $request->input('min_price', 0);
        $maxPrice = $request->input('max_price', null);
        $orderBy = $request->input('order_by', 'name');
        $orderDirection = $request->input('order_direction', 'asc');

        $query = Product::query();

        if (!empty($search)) {
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
        }

        if (!empty($category)) {
            $query->where('category', $category);
        }

        if ($minPrice > 0) {
            $query->where('price', '>=', (float) $minPrice);
        }

        if (!is_null($maxPrice)) {
            $query->where('price', '<=', (float) $maxPrice);
        }

        $query->orderBy($orderBy, $orderDirection);

        $products = $query->paginate(10);

        return view('products.index', compact('products'));
    }

    // Termék létrehozási oldal
    public function create()
    {
        return view('products.create');
    }

    // Új termék mentése
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string|max:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->unit = $request->unit;
        $product->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $product->image_path = $path;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Termék sikeresen létrehozva!');
    }

    // Termék megjelenítése
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    // Termék szerkesztési oldal
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    // Termék frissítése
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string|max:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->unit = $request->unit;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $product->image_path = $path;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Termék sikeresen frissítve!');
    }

    // Termék törlése
    public function destroy(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->image_path) {
            \Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        $redirectTo = $request->input('redirect_to', route('products.index'));

        return redirect($redirectTo)->with('success', 'Termék sikeresen törölve!');
    }
}
