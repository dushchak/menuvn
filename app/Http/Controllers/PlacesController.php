<?php
namespace App\Http\Controllers;

use DateTimeImmutable;

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

        // ціна за 100гр.
        foreach($menu as $dish){
            if(!empty($dish->portionweight)){
                $dish->cost100g = round( ($dish->portioncost / $dish->portionweight)*100);
            } 
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

    public function upPlace(Places $place){
        
        return view ('formUpPlace');
    }

    // Всі * ПРОМО оголошення, бо в AdsController перевіряється Auth 
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

        public function placeAds(Places $place)
    {
        $ads = $place->ads()->get();

        // перевірка чи є Підписка
        //$str_payed = "06-10-2023"; //test

        try{
            if($place->adsto != null){
                $now  = new DateTimeImmutable();  //obj "now"
                $payed_to = new DateTimeImmutable($place->adsto);  //obj "2023-01-01"(db)
                if ($payed_to < $now){
                    $tarif = false;
                }
                else{
                    $tarif = true;
                }
            }
            else{
                $tarif = false;
            }
        }
        catch(Exception $e){
            echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
        }

##        $new_payed = $promo_to->format('Y-m-d');


        //dd($tarif);
        return view('placeAds', ['ads'=>$ads,'place'=>$place, 'tarif'=>$tarif ]);
    } 
}
