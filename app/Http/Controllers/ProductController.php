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
        $orderBy = $request->input('order_by', 'name');
        $orderDirection = $request->input('order_direction', 'asc');

        $query = Product::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            }); // Zárójel biztosan zárva
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

        // Kategóriák lekérdezése
        $categories = Product::select('category')->distinct()->get();

        // Népszerű termékek lekérdezése
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
    } // <- Zárva a index metódus
} // <- Zárva a ProductController osztály