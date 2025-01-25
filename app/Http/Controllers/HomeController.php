<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Népszerű termékek lekérdezése (max 4 elem)
        $popularProducts = Product::orderBy('views', 'desc')->take(4)->get();

        // Termékek darabszáma kategóriánként
        $categoryCounts = Product::select('category', \DB::raw('COUNT(*) as count'))
            ->groupBy('category')
            ->pluck('count', 'category');

        // Minden termék lapozva (10 termék/oldal)
        $products = Product::paginate(10);

        // Tartományok generálása a lapozáshoz
        $totalItems = $products->total();
        $perPage = $products->perPage();
        $ranges = [];

        if ($totalItems > 0) {
            for ($start = 1; $start <= $totalItems; $start += $perPage) {
                $end = min($start + $perPage - 1, $totalItems);
                $ranges[] = ['start' => $start, 'end' => $end];
            }
        }

        // Nézet visszatérése adatokkal
        return view('home', compact('popularProducts', 'categoryCounts', 'products', 'ranges'));
    }
}
