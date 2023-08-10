<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Places;

class PlacesController extends Controller
{
    //
    public function index(){
        
        $places = Places::latest()->get();
            
        return view ('index', ['places' => $places]); // вивід таблиці закладів
    }
}
