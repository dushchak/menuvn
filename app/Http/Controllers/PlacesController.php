<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Places;

class PlacesController extends Controller
{
    //
    public function index(){
        $places = Places::latest()->get();
        $s = "\r\n";
        foreach($places as $pl){
            $s .= $pl->name ."\r\n";
            $s .= $pl->adress ."\r\n";
            $s .= $pl->desc ."\r\n";
            $s .= $pl->delivery ."\r\n";
        }
        //return response($s)->header('Content-Type','text/plain');
        return view ('index', ['places' => $places]);
    }
}
