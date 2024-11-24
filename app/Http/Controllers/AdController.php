<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class AdController extends Controller
{
    public function index()
    {
        // Csak a bejelentkezett felhasználó termékeit listázzuk
        $ads = Product::where('user_id', Auth::id())->get();

        return view('ads.index', compact('ads'));
    }
}
