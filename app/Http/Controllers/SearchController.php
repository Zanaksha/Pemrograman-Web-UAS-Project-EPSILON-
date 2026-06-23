<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarModel;
use App\Models\Product;

class SearchController extends Controller
{
public function index(Request $request)
{
    $query = $request->input('q');

    $cars = collect();
    $products = collect();

    if ($query) {
        $cars = CarModel::where('name', 'like', "%{$query}%")->get();

        $products = Product::where('name', 'like', "%{$query}%")->get();
    }

    return view('search', compact('cars', 'products', 'query'));
}
}