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
        
        $places = Places::orderBy('position','desc')->get();
        //$countAds = count ($places->ads()->latest()->get()); // підрахунок кількості Ads ресторана > Акції
        //dd($countAds);    
        return view ('index', ['places' => $places]); // вивід таблиці закладів
    }

    public function viewPlace(Places $place) {
        //dd($place);
        return view ('viewPlace', ['place' => $place]); 
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
        if(empty($request)) {
            $request->stlqr = "square"
              $request->qrsize = 500;
              $request->qrcolor = "#e66465";
              $request->qrbg = "#ffffff";
              
              $request->grad_col_1 = "#e66465";
              $request->grad_col_2 =  "#ffffff";
       }


        
        // 
        $arrColor=str_split(substr($request->qrcolor, 1), 2);
        if(empty($arrColor)){
            $arrColor = array(124, 200);
        }
        foreach ($arrColor as $key) {
            $arrColorDec[] = intval(hexdec($key));
        }
        $request->qrcolor = $arrColorDec;
        #$QRparm['color1'] = $arrColorDec;

        // 
        $arrBg = str_split(substr($request->qrbg, 1),2);
        if(empty($arrBg)){
            $arrBg = array(124, 200);
        }
        foreach ($arrBg as $key) {
            $arrBgDec[] = hexdec($key);
        }
        $request->qrbg = $arrBgDec;
        #$QRparm['bg'] = $arrBgDec;

        // 1 цвет градиента 
        $arrGrad1 = str_split(substr($request->grad_col_1, 1), 2);
        if(empty($arrGrad1)){
            $arrGrad1 = array(124, 200);
        }
        foreach ($arrGrad1 as $key) {
            $arrGradCol1[] = intval(hexdec($key));
        }
        $request->grad_col_1 = $arrGradCol1;
        #$QRparm['grad1'] = $arrGradCol1;

        // 2 цвет градиента 
        $arrGrad2 = str_split(substr($request->grad_col_2, 1), 2);
        if(empty($arrGrad2)){
            $arrGrad2 = array(124, 200);
        }
        foreach ($arrGrad2 as $key) {
            $arrGradCol2[] = intval(hexdec($key));
        }
        $request->grad_col_2 = $arrGradCol2;
        #$QRparm['grad2'] = $arrGradCol2;


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
