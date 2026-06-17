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
        $vin = strtoupper($request->vin);
        $warranty = \App\Models\Warranty::where('vin', $vin)->first();

        if (!$warranty) {
            return back()->with('error', 'VIN tidak ditemukan.')->withInput()->with('error_flag', true);
        }

        return view('warranty', compact('warranty'))->with('vin', $vin);
    }
}