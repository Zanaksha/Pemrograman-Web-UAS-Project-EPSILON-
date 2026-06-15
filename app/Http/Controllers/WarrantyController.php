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
        $email = $request->email;
        $warranty = \App\Models\Warranty::where('vin', $vin)->first();

        if (!$warranty) {
            return back()->with('error', 'VIN tidak ditemukan.')->withInput();
        }

        if (strtolower($warranty->owner_email) !== strtolower($email)) {
            return back()->with('error', 'Email tidak sesuai dengan pemilik VIN ini.')->withInput();
        }

        return view('warranty', compact('warranty'))->with('vin', $vin);
    }
}