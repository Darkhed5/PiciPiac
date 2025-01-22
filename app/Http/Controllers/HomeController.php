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

        // Minden termék lapozva (opcionális, ha a terméklista szükséges)
        $products = Product::paginate(10); // 10 termék/oldal

        // Nézet visszatérése adatokkal
        return view('home', compact('popularProducts', 'categoryCounts', 'products'));
    }
}
