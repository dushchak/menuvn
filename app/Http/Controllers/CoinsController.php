<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeImmutable;
//use DatePeriod;
//use DateInterval;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // підключаєм трейт фасад авторизації 

use App\Models\Places;
use App\Models\Coins;
use App\Models\Ads;

/*
        'coins_before',
        'operation_sum',
        'coins_after',
        'user_id',
        'typeoperation',
        'comment',
*/

class CoinsController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth'); // всі дії Coins роблять залоговані користувачі
    }

    public function formAddConis(Places $place){
        //dd($place);
        
        return view('formAddCoins', ['place'=>$place]);
    }

    public function addCoins(Request $request, Places $place){
        //dd($request);
        $idUser = Auth::user()->id;

        $lastpay = $place->coins()->orderBy('id','desc')->first('coins_after')   ; // залишок на рахунку в останній операції
        //dd($lastpay );
        if($lastpay == null){
            $coins_before = 0;
        }
        else{
            $coins_before = $lastpay->coins_after;
        }
        
        $sum = $request->addsum;
        $comment = $request->comment;

        //dd($coins_before, $sum);

        
        $coins = new Coins();
        $coins->fill([
            'coins_before' => intval($coins_before),     // 0
            'operation_sum' => intval($sum),    // 10
            'coins_after' => $coins_before + $sum,      // before+sum
            'user_id' => Auth::user()->id,      // Auth::user->id
            'typeoperation'=> "add",    // "add"
            'comment' => $comment,          // "поповнення"
        ]);
        $place->coins()->save($coins);

        return redirect()->route('home');
    }


    private function userCoins(){
        $coins = Auth::user()->coins()->orderBy('id','desc')->first('coins_after');
        if($coins){
            $coin_sum = $coins->coins_after;
        }
        else {
            $coin_sum = 0;
        }
        return $coin_sum;
    }

    public function formBuyAds (Places $place){
        $coin_sum = $this->userCoins();

        return view('formBuyAds', ['place' => $place,'coins'=>$coin_sum]  );
    }

    public function formNoAds (Places $place){
        $coin_sum = $this->userCoins();
        
        return view('formNoAds', ['place' => $place,'coins'=>$coin_sum]  );
    }

    public function formUpPlace(Places $place){
        $coin_sum = $this->userCoins();  
        return view ('formUpPlace', ['place'=>$place,'coins'=>$coin_sum]);
    }


    public function tariffs(Request $request, Places $place){
        switch($request->tariff){
            case 'noAds1m':
                $result = $this->payNoAds($place,'m1');
                break;
            case 'noAds12m':
                $result = $this->payNoAds($place,'m12');
                break;
            default:
                dd('noone tariff selected');
                break;    
        }
        if($result=='nomoney')
            return view('pageNoCoins', ['place' => $place]); // сторінка "Недостатньо коштів"
        else{
            return redirect()->route('home');
        }

        
    }


    private function payNoAds(Places $place, $period ){

        switch ($period) {
            case 'm1':
                $sum = -5;  //  ціна за 12міс noAds
                $comment = "1М noAds ".$place->name;
                $period = "m1";
                break;
            case 'm12':
                $sum = -49;   // ціна за 12міс noAds
                $comment = "12М noAds ".$place->name;
                $period = "m12";
                break;
            default:
                dd("Error value 'period'"); // tyt redirect to error page!!!!!!!!!!!!!!!!!!!
                //redirect()->;
                break;
        }
        
    
        $typeoperation = "buyNoAds";
        //dd($place, $sum, $typeoperation, $comment,);

        $result = $this->pay($place, $sum, $typeoperation, $comment); // Спочатку!! ПЕРЕВІРКА и списание монет

        if($result == 'nomoney'){
            return 'nomoney';
        }
        else{
            $this->storeDate($place, 'noads', $period); // до якої дати буде діяти  
        }

        
    }


    public function payPromo(Request $request, Places $place ){
        switch ($request->period) {
            case 'm1':
                $sum = -10;                    // ціна за місяць рекламних постерів
                $comment = "1М Промо ".$place->name;
                $period = "m1";
                break;
            case 'm6':
                $sum = -55;                    // ціна за 6місяць рекламних постерів
                $comment = "6М Промо ".$place->name;
                $period = "m6";
                break;
            case 'm12':
                $sum = -90;                    // ціна за 12місяць рекламних постерів
                $comment = "12М Промо ".$place->name;
                $period = "m12";
                break;
            default:
                dd("Error value 'period'"); // tyt redirect to error page!!!!!!!!!!!!!!!!!!!
                //redirect()->;
                break;
        }

        $typeoperation = "promoto";

        $result = $this->pay($place, $sum, $typeoperation, $comment);
        if($result == 'nomoney'){
            return view('pageNoCoins', ['place' => $place]); // сторінка "Недостатньо коштів"
        }
        else {
            $this->storeDate($place, $typeoperation, $period);
        }

        return redirect()->route('home');
    }




    public function upTop(Request $request, Places $place ){
        switch ($request->period) {
            case 'm1':
                $sum = -10;                    // ціна за місяць рекламних постерів
                $comment = "1М ТОП ".$place->name;
                $period = "m1";
                break;
            case 'm6':
                $sum = -55;                    // ціна за 6місяць рекламних постерів
                $comment = "6М ТОП ".$place->name;
                $period = "m6";
                break;
            case 'm12':
                $sum = -90;                    // ціна за 12місяць рекламних постерів
                $comment = "12М ТОП ".$place->name;
                $period = "m12";
                break;
            default:
                dd("Error value 'period'"); // tyt redirect to error page!!!!!!!!!!!!!!!!!!!
                //redirect()->;
                break;
        }

        $typeoperation = "toplist";

        $result = $this->pay($place, $sum, $typeoperation, $comment); // операції з монетами
        if($result == 'nomoney'){

            return redirect()->route('coins.nocoins');
            return view('pageNoCoins', ['place' => $place]); // сторінка "Недостатньо коштів"
        }
        else{
            $store = $this->storeDate($place, $typeoperation, $period);  // запис кінцевої дати послуги 
            //dd($store, $typeoperation, $period);
            $place->position = 1;
            $place->save();
        
        }

        return redirect()->route('home');

    } 

    //
    private function storeDate(Places $place, $typepayment, $period ){
        //dd($typepayment);
        switch($typepayment){
            case 'promoto':
                $str_payed = $place->adsto;
                $field = 'adsto';           // name table column
                break;
            case 'noads':
                $str_payed = $place->noadsto;
                $field = 'noadsto';         // name table column
                break;
            case 'toplist':
                $str_payed = $place->positionto;
                $field = 'positionto';         // name table column
                break;
            default:
                //dd('Error: 159 $typepayment'); // error page
                break;
        }

        switch ($period) {
            case 'm1':
                $timeper = "+ 1 month";
                break;

            case 'm12':
                $timeper = "+ 12 month";
                break;
            
            default:
                dd('Error: chkDate() - $period ???');
                //return     ; // error "period"
                break;
        }
        //$str_payed = "06-10-2023"; //test

        $now  = new DateTimeImmutable();                //obj "now"
        $payed_to = new DateTimeImmutable($str_payed);  //obj "payed_at"
        //$payed_to = null;                             // str, tests

        if($str_payed == null){
            $promo_to = new DateTimeImmutable($timeper); // +1М реклами
        }
        elseif ($payed_to < $now) {
            $promo_to = new DateTimeImmutable($timeper); // +1М реклами
        }
        elseif ($payed_to >= $now) {
            $promo_to = $payed_to->modify($timeper); // додатково +1М реклами
        }

        $new_payed = $promo_to->format('Y-m-d');

        //dd($field, $new_payed);
        $place->fill([
            $field => $new_payed,  // 'adsto' => '2023-11-01'
        ]);
        $place->save();
    }

    private function pay (Places $place, $sum, $typeoperation, $comment) {
        //dd($place, $sum, $typeoperation, $comment,);

        //$lastpay = $place->coins()->orderBy('id','desc')->first('coins_after')   ; // залишок на рахунку в останній операції
        $lastpay = Auth::user()->coins()->orderBy('id','desc')->first('coins_after');
        //dd($lastpay);
        if($lastpay == null || $lastpay->coins_after+$sum < 0){
            //dd('nomoney');
            return 'nomoney'; // flag to show "noMoney" page

        }
        else{
            $coins_before = $lastpay->coins_after;
             //dd($coins_before);
        }
       

        $coins = new Coins();
        $coins->fill([
            'coins_before' => intval($coins_before),     // 0
            'operation_sum' => intval($sum),    // 10
            'coins_after' => $coins_before + $sum,      // before+sum
            'user_id' => Auth::user()->id,      // Auth::user->id
            'typeoperation'=> $typeoperation,    // "add"
            'comment' => $comment,          // "поповнення"
        ]);
        $result= $place->coins()->save($coins);
        //dd($result);
    }



    public function pageNoCoins(Places $place){
        return view ('pageNoCoins', ['place'=>$place]);
    } 


}
