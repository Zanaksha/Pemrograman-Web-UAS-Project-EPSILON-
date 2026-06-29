<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sparepart;

class SparepartController extends Controller
{
    public function index(Request $request)
    {
        $query = Sparepart::query();

        if ($request->category) {
            $query->where('category', $request->category);
        }

        $spareparts = $query->get();

        return view('spareparts', compact('spareparts'));
    }

    public function show($id)
    {
        $sparepart = Sparepart::findOrFail($id);
        return view('sparepart-detail', compact('sparepart'));
    }
}