<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warranty;

class WarrantyController extends Controller
{
    public function index()
    {
        return view('warranties');
    }

    public function check(Request $request)
    {
        $request->validate([
            'vin' => 'required|string'
        ]);

        $warranty = Warranty::where('vin', strtoupper($request->vin))->first();

        return view('warranty', compact('warranty'));
    }
}