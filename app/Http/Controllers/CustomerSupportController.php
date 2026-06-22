<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class CustomerSupportController extends Controller
{
    public function index()
    {
        $faqs = \App\Models\Faq::all();
        return view('customer', compact('faqs'));
    }

    public function search(Request $request)
    {
        $q = trim($request->query('q', ''));

        if (!$q) {
            return response()->json([]);
        }

        $results = Faq::where('question', 'like', "%{$q}%")
                    ->select('question','answer', 'tag')
                    ->limit(6)
                    ->get();

        return response()->json($results);
    }
}