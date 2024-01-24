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

        $now  = new DateTimeImmutable();  //obj "now"
        $nowDate = $now->format('Y-m-d');

        // беремо рандомні 5закладів для Списку закладів
        $topplaces = Places::inRandomOrder()->where('moderate', 1)->where('positionto','>', $nowDate)->limit(5)->get();
        //dd($topplaces);
        
        $places = Places::inRandomOrder()->where('moderate', 1)->orderBy('position','desc')->get();
        //$countAds = count ($places->ads()->latest()->get()); // підрахунок кількості Ads ресторана > Акції
        //dd($countAds);    
        return view ('index', ['places' => $places, 'topplaces'=>$topplaces]); // вивід таблиці закладів
    }

    public function viewPlace(Places $place) {
        //dd($place);
        return view ('viewPlace', ['place' => $place]); 
    }

    // перегляд меню
    public function viewMenu(Places $place) {
        $now  = new DateTimeImmutable();  //obj "now"
        $noads_to = new DateTimeImmutable($place->noadsto);  //obj "2023-01-01"(db)
        $ads_to = new DateTimeImmutable($place->adsto);
        $position_to = new DateTimeImmutable($place->positionto);

        if($noads_to < $now || $place->noadsto == null){
            $tarif_1 = true; //+Ads
        }
        else{
            $tarif_1 = false;
        }
        if($ads_to<$now || $place->adsto == null){
            $tarif_2 = true;
        }
        else{
            $tarif_2 = false;
        }
        if($position_to<$now || $place->positionto == null){
            $tarif_3 = true;
        }
        else{
            $tarif_3 = false;
        }


        if($tarif_1 /* &&$tarif_2&&$tarif_3 */ ){
            // беремо рандомні оголошення для меню
            $ads = Ads::inRandomOrder()->limit(30)->get();
            foreach($ads as $item){
                $item->place = Places::find($item->places_id) ;
                $adverts[] = $item; 
            }
            //dd($ads);
        }
        else {  
            $ads = [];
        }


        // якщо заклад не відключено
        if($place->disabled != 1){
            $menu = $place->dishes()->orderBy('dishgroup','asc')->orderBy('position','desc')->get();    
        }
        else{
            $menu = $place->dishes()->latest()->get(); 
        }

        // вираховуємо ціну за 100гр.
        foreach($menu as $dish){
            if(!empty($dish->portionweight)){
                $dish->cost100g = round( ($dish->portioncost / $dish->portionweight)*100);
            } 
        }

        //$groups['main_dish'] = 0;
        $groups = array(
            'main_dish'=> 0,
            'cold_dish'=> 0,
            'hot_dish'=> 0,
            'soup'=> 0,
            'garnir'=> 0,
            'salat'=> 0,
            'desert'=> 0,
            'hot_drink'=> 0,
            'cold_drink'=> 0,
            'beer'=> 0,
            'vine'=> 0,
            'hard_alc'=> 0,
            'alc_drink'=> 0,
            'coctail'=> 0,
        );
        $flag = 0;
        
        if($place->disabled == 0){
            
            if(count ($menu) > 0){ 
                
                foreach($menu as $dish){
                    switch($dish->dishgroup){
                        case(1):
                            $groups['main_dish']=1;
                        break;
                        case(2):
                            $groups['cold_dish']=1;
                            $flag = 1;
                        break;
                        case(3):
                            $groups['hot_dish']=1;
                            $flag = 1;
                        break;
                         case(4):
                            $groups['soup']=1;
                            $flag = 1;
                        break;
                        case(5):
                            $groups['garnir']=1;
                            $flag = 1;
                        break;
                        case(6):
                            $groups['salat']=1;
                            $flag = 1;
                        break;
                        case(7):
                            $groups['desert']=1;
                            $flag = 1;
                        break;
                        case(8):
                            $groups['hot_drink']=1;
                            $flag = 1;
                        break;
                        case(9):
                            $groups['cold_drink']=1;
                            $flag = 1;
                        break;
                        case(10):
                            $groups['beer']=1;
                            $flag = 1;
                        break;
                        case(11):
                            $groups['vine']=1;
                            $flag = 1;
                        break;
                        case(12):
                            $groups['hard_alc']=1;
                            $flag = 1;
                        break;
                        case(13):
                            $groups['alc_drink']=1;
                            $flag = 1;
                        break;
                        case(14):
                            $groups['coctail']=1;
                            $flag = 1;
                        break;
                        default:
                    }
                }
                // якщо тільки main_dish приховуєм якорні лінки в меню
                if($groups['main_dish'] && $flag == 0){
                    $groups['main_dish'] = 0;
                }
            }
        }
        //dd($groups);


        return view ('viewmenu', ['menu'=>$menu, 'place'=>$place, 'groups'=>$groups , 'ads'=>$ads] ); // вивід dishes

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
        $now  = new DateTimeImmutable();  //obj "now"
        $nowDate = $now->format('Y-m-d');

        $adsto_places = Places::where('moderate', 1)->where('adsto','>', $nowDate)->limit(400)->get();
            //dd($adsto_places);

        foreach($adsto_places as $place){
            $ads = $place->ads()->latest()->get();

            foreach($ads as $adv){
                $adv->place = $place;
                $allAds[]=$adv;    
            }
        }
        if(!isset($allAds)){
            $allAds=[];
        }

        //$ads = Ads::latest()->get();
        //dd($ads);
        
        return view ('allAds', ['ads'=>$allAds]);
    }

        //      /placeads/7 - всі оголошення 1 закладу
        public function placeAds(Places $place)
    {
        $now  = new DateTimeImmutable();  //obj "now"
        $payed_to = new DateTimeImmutable($place->adsto);

        // перевірка чи є Підписка
        if($place->adsto == null || $payed_to < $now){
            $tarif = false;
        }
        else {  
            $tarif = true;
        }

        $ads = $place->ads()->get();
        
        

        // перевірка чи є Підписка
        //$str_payed = "06-10-2023"; //test

            // if($place->adsto != null){
            //       //obj "2023-01-01"(db)
            //     if ($payed_to < $now){
            //         $tarif = false;
            //     }
            //     else{
            //         $tarif = true;
            //     }
            // }
            // else{
            //     $tarif = false;
            // }
        

##        $new_payed = $promo_to->format('Y-m-d');


        //dd($tarif);
        return view('placeAds', ['ads'=>$ads,'place'=>$place, 'tarif'=>$tarif ]);
    } 
}
