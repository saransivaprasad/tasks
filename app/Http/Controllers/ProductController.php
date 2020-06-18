<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $price = rand(100, 1000);
        $request->session()->put('price', $price);
        return view('product', compact('price'));
    }
}
