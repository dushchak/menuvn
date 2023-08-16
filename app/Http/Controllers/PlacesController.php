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
    public function viewMenu(Places $place) {
        //dd($placeid);

        if($place->disabled != 1){
            $menu = $place->dishes()->orderBy('position','desc')->get();    
        }
        //dd($menu);

        return view ('viewmenu', ['menu'=>$menu ] ); // вивід dishes

    }

    public function printQR(Places $place){
        //dd($place);
        return view ('QRpage', ['place'=>$place]);
    } 
}
