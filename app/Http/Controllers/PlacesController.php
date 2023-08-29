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

    public function printQR(Request $request, Places $place){
        //dd($request);
        $menuurl = route('viewMenu', ['place' => $place->id ]); // генеруємо  адресу МЕНЮ з іменованого Роута  )))
        
        $arrColor=str_split(substr($request->qrcolor, 1), 2);
        foreach ($arrColor as $key) {
            $arrColorDec[] = intval(hexdec($key));
        }
        $request->qrcolor = $arrColorDec;


        $arrBg = str_split(substr($request->qrbg, 1),2);
        foreach ($arrBg as $key) {
            $arrBgDec[] = hexdec($key);
        }
        $request->qrbg = $arrBgDec;

        $arrGrad1 = str_split(substr($request->grad_col_1, 1), 2);
        foreach ($arrGrad1 as $key) {
            $arrGradCol1[] = intval(hexdec($key));
        }
        $request->grad_col_1 = $arrGradCol1;

        $arrGrad2 = str_split(substr($request->grad_col_2, 1), 2);
        foreach ($arrGrad2 as $key) {
            $arrGradCol2[] = intval(hexdec($key));
        }
        $request->grad_col_2 = $arrGradCol2;


        //dd($request->grad_col_1);

        return view ('QRpage', ['place'=>$place, 'menuurl'=>$menuurl, 'qrstyle'=>$request]);
    }

    public function printQRstyle(Request $request, Places $place){
        //dd($request);
        return $this->printQR($request, $place);
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
