<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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
}
