<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarModel;
use App\Models\Product;
use App\Models\Sparepart;

class SearchController extends Controller
{
public function index(Request $request)
{
    $query = $request->input('q');

    $cars = collect();
    $products = collect();
    $spareparts = collect();

    if ($query) {
        $cars = CarModel::where('name', 'like', "%{$query}%")->get();

        $products = Product::where('name', 'like', "%{$query}%")->get();

        $spareparts = Sparepart::where('name', 'like', "%{$query}%")->get();
    }

    return view('search', compact('cars', 'products', 'spareparts', 'query'));
}
}