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
<<<<<<< HEAD
        return view('beli');
=======
        return view('detail');
>>>>>>> a312fddf1c54c060e6fe6f65d67bf1c7575797a3
    }
}
