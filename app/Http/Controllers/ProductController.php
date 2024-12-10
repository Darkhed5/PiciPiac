<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Lekérdezési paraméterek begyűjtése
        $search = $request->input('search', '');
        $category = $request->input('category', '');
        $minPrice = $request->input('min_price', 0);
        $maxPrice = $request->input('max_price', null);
        $inStock = $request->boolean('in_stock', false);
        $orderBy = $request->input('order_by', 'name');
        $orderDirection = $request->input('order_direction', 'asc');

        // Biztonsági ellenőrzés az order_by és order_direction értékekre
        $allowedOrderBy = ['name', 'price', 'views'];
        $allowedOrderDirection = ['asc', 'desc'];

        if (!in_array($orderBy, $allowedOrderBy)) {
            $orderBy = 'name';
        }
        if (!in_array($orderDirection, $allowedOrderDirection)) {
            $orderDirection = 'asc';
        }

        // Termékek lekérdezése
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

        // Eredmények
        $products = $query->paginate(10);

        // Kategóriák lekérdezése
        $categories = Product::select('category')->distinct()->get();

        // Népszerű termékek lekérdezése
        $popularProducts = Product::orderBy('views', 'desc')->take(4)->get();

        // Nézet visszatérése adatokkal
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
        // Új termék létrehozására szolgáló nézet megjelenítése
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Új termék mentése
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
        $product->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image_path = $path;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Termék sikeresen létrehozva!');
    }
}
