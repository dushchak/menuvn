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

        #var 1
        //$menu = Places::where ($placeid);
        // $menu->dishes()->latest()->get();

        #var 2
        //$menu = Dish::all();

         $menu = Dish::where('places_id', $placeid)->orderBy('dishgroup','asc')->orderBy('position','asc')->get();
        //dd($menu);

        return view ('viewmenu', ['menu'=>$menu, 'placeid'=>$placeid] ); // вивід dishes

    }

    public function printQR(){

        return view ('QRpage');
    } 
}
