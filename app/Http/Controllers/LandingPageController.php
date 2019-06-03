<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $products = Product::mightAlsoLike()->get();
        return view('welcome',compact('products'));
    }
}
