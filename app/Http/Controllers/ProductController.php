<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $inStock = $request->boolean('in_stock');
        $orderBy = $request->input('order_by', 'name'); // Alapértelmezett rendezés: név szerint
        $orderDirection = $request->input('order_direction', 'asc'); // Alapértelmezett: növekvő

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
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }

        if ($inStock) {
            $query->where('stock', '>', 0);
        }

        $query->orderBy($orderBy, $orderDirection);

        $products = $query->paginate(10);

        // Kategóriák lekérdezése
        $categories = Product::select('category')->distinct()->get();

        // Legnépszerűbb termékek lekérdezése
        $popularProducts = Product::orderBy('views', 'desc')->take(4)->get();

        return view('home', compact('products', 'categories', 'popularProducts', 'search', 'category', 'minPrice', 'maxPrice', 'inStock', 'orderBy', 'orderDirection'));
    }
}
