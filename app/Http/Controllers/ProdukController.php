<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        return view('produk');
    }

  public function buyer()
    {
        return view('beli');
    }

    public function detail()
    {
        return view('detail');
    }
}
