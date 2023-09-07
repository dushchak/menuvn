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
        'operator_id',
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
            'operator_id' => Auth::user()->id,      // Auth::user->id
            'typeoperation'=> "add",    // "add"
            'comment' => $comment,          // "поповнення"
        ]);
        $place->coins()->save($coins);

        return redirect()->route('home');
    }

    public function buyAds (Places $place){
        //dd($place);

        return view('buyAds', ['place' => $place]  );
    }

    public function formNoAds (Places $place){
        return view('formNoAds', ['place' => $place]  );
    }


    public function payAds(Places $place ){
        $sum = -10;                    // ціна за місяць рекламних постерів
        $typeoperation = "buyAds";
        $comment = "1М промо ".$place->name;

        $this->pay($place, $sum, $typeoperation, $comment);
        $this->storeDate($place, 'ads', 'm1');

        return redirect()->route('home');
    }


    public function payNoAds(Places $place ){
        $sum = -10;                    // ціна за місяць рекламних постерів
        $typeoperation = "buyNoAds";
        $comment = "1М БЕЗ реклами ".$place->name;

        $this->pay($place, $sum, $typeoperation, $comment);
        $this->storeDate($place, 'noads', 'm1');

        return redirect()->route('home');
    }

    //
    private function storeDate(Places $place, $typepayment, $period ){
        //dd($place);
        switch($typepayment){
            case 'ads':
                $str_payed = $place->adsto;
                $field = 'adsto';           // name table column
                break;
            case 'noads':
                $str_payed = $place->noadsto;
                $field = 'noadsto';         // name table column
                break;
            default:
                break;
        }

        switch ($period) {
            case 'm1':
                $timeper = "+ 1 month";
                break;
            case 'm6':
                $timeper = "+ 6 month";
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
        //dd($place, $request);

        $lastpay = $place->coins()->orderBy('id','desc')->first('coins_after')   ; // залишок на рахунку в останній операції
        //dd($lastpay);
        if($lastpay == null || $lastpay->coins_after+$sum <= 0){
            return redirect()->route('home'); // сторінка "Недостатньо коштів"
        }
        else{
            $coins_before = $lastpay->coins_after;
        }
        

        $coins = new Coins();
        $coins->fill([
            'coins_before' => intval($coins_before),     // 0
            'operation_sum' => intval($sum),    // 10
            'coins_after' => $coins_before + $sum,      // before+sum
            'operator_id' => Auth::user()->id,      // Auth::user->id
            'typeoperation'=> $typeoperation,    // "add"
            'comment' => $comment,          // "поповнення"
        ]);
        $place->coins()->save($coins);

        return redirect()->route('home');
    }

    public function formUpPlace(Places $place){
        
        return view ('formUpPlace', ['place'=>$place]);
    } 
}
