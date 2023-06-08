<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Structure;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function showApartment(){
        $apartments= Apartment::with('structure')->get();
        return view('home', compact('apartments'));
    }
    public function showSingleApartment(Apartment $apartment){
        return view('apartment.apartment', compact('apartment'));
    }
}
