<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Places;
use App\Models\Dish;



class PlacesController extends Controller
{
    //
    public function index(){
        
        $places = Places::latest()->get();
            
        return view ('index', ['places' => $places]); // вивід таблиці закладів
    }


    // перегляд меню
    public function viewMenu($placeid) {

        $menu = Dish::where('places_id', $placeid)->get();

        //dd($menu);

        return view ('viewmenu', ['menu'=>$menu, 'placeid'=>$placeid] ); // вивід dishes

    }
}
