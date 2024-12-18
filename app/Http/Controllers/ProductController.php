<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $category = $request->input('category', '');
        $minPrice = $request->input('min_price', 0);
        $maxPrice = $request->input('max_price', null);
        $inStock = $request->boolean('in_stock', false);
        $orderBy = $request->input('order_by', 'name');
        $orderDirection = $request->input('order_direction', 'asc');

        $allowedOrderBy = ['name', 'price', 'views'];
        $allowedOrderDirection = ['asc', 'desc'];

        if (!in_array($orderBy, $allowedOrderBy)) {
            $orderBy = 'name';
        }
        if (!in_array($orderDirection, $allowedOrderDirection)) {
            $orderDirection = 'asc';
        }

        $query = Product::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        if ($category) {
            $query->where('category', $category);
        }

        if ($minPrice) {
            $query->where('price', '>=', (float) $minPrice);
        }

        if ($maxPrice) {
            $query->where('price', '<=', (float) $maxPrice);
        }

        if ($inStock) {
            $query->where('stock', '>', 0);
        }

        $query->orderBy($orderBy, $orderDirection);

        $products = $query->paginate(10);

        $categories = Product::select('category')->distinct()->get();

        $popularProducts = Product::orderBy('views', 'desc')->take(4)->get();

        return view('home', compact(
            'products',
            'categories',
            'popularProducts',
            'search',
            'category',
            'minPrice',
            'maxPrice',
            'inStock',
            'orderBy',
            'orderDirection'
        ));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->stock = $request->input('stock', 0);
        $product->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image_path = $path;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Termék sikeresen létrehozva!');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->stock = $request->stock;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image_path = $path;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Termék sikeresen frissítve!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image_path) {
            \Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Termék sikeresen törölve!');
    }
}