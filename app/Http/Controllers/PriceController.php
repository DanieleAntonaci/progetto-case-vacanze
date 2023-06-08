<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function showPrice(){
        $prices= Price::with('apartments')-> get();
        return view('price.prices', compact('prices'));
    }
}
