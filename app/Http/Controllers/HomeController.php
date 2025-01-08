<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class HomeController extends Controller
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

        // Keresési feltételek
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // Kategória szűrés
        if (!empty($category)) {
            $query->where('category', $category);
        }

        // Ár szűrés
        if ($minPrice > 0) {
            $query->where('price', '>=', (float) $minPrice);
        }

        if (!is_null($maxPrice)) {
            $query->where('price', '<=', (float) $maxPrice);
        }

        // Készlet szűrés
        if ($inStock) {
            $query->where('stock', '>', 0);
        }

        // Rendezés
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
}