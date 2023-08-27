<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Places;
use App\Models\Dish;
use App\Models\Ads;



class PlacesController extends Controller
{
    //
    public function index(){
        
        $places = Places::latest()->get();
            
        return view ('index', ['places' => $places]); // вивід таблиці закладів
    }


    // перегляд меню
    public function viewMenu(Places $place) {
        //dd($place->id);

        if($place->disabled != 1){
            $menu = $place->dishes()->orderBy('dishgroup','asc')->orderBy('position','desc')->get();    
        }
        else{
            $menu = $place->dishes()->latest()->get(); 
        }
        //dd($menu);

        return view ('viewmenu', ['menu'=>$menu, 'place'=>$place ] ); // вивід dishes

    }

    public function printQR(Places $place){
        //dd($place);
        return view ('QRpage', ['place'=>$place]);
    }

    public function allAds () {
        $ads = Ads::latest()->get();
        //dd($ads);
        
        foreach($ads as $item){
            $item->place = Places::find($item->places_id) ;
            $adverts[] = $item; 
        }
        //dd($adverts);
        
        
        return view ('allAds', ['ads'=>$adverts]);
    }

    public function adsPlace(Places $place){

        $ads = $place->ads()->get();
        //dd($ads);

        return view ('placeAds', ['ads'=>$ads, 'place'=>$place]);    
    }

    public function upPlace(Places $place){
        
        return view ('formUpPlace');
    } 
}
