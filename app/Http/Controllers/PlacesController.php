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
        
        $places = Places::where('moderate', 1)->orderBy('position','desc')->get();
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
     


        
        // колір точок QR кода
        $request->headercolor = "#999";
        if($request->grad == "1"){
            $request->headercolor = $request->grad_col_1;    
        }
        else {
            $request->headercolor = $request->qrcolor;
        }
        //$request->headercolor = $request->qrcolor;

        if($request->qrsize != null){
            $arrColor=str_split(substr($request->qrcolor, 1), 2);
            foreach ($arrColor as $key) {
                $arrColorDec[] = intval(hexdec($key));
            }
            $request->qrcolor = $arrColorDec;
            

            // background color 
            $arrBg = str_split(substr($request->qrbg, 1),2);       
            foreach ($arrBg as $key) {
                $arrBgDec[] = hexdec($key);
            }
            $request->qrbg = $arrBgDec;
           
            // 1 цвет градиента 
            $arrGrad1 = str_split(substr($request->grad_col_1, 1), 2);
            foreach ($arrGrad1 as $key) {
                $arrGradCol1[] = intval(hexdec($key));
            }
            $request->grad_col_1 = $arrGradCol1;
            

            // 2 цвет градиента 
            $arrGrad2 = str_split(substr($request->grad_col_2, 1), 2);
            foreach ($arrGrad2 as $key) {
                $arrGradCol2[] = intval(hexdec($key));
            }
            $request->grad_col_2 = $arrGradCol2;
        }
        


        //dd($request);
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
