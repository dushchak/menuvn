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

        $now  = new DateTimeImmutable();
    
        $str_payed = "06-10-2023";
        $payed_to = new DateTimeImmutable($str_payed);
        //$payed_to = null; // tests

        if($str_payed == null){
            $promo_to = new DateTimeImmutable("+ 1 month"); // +1М реклами
        }
        elseif ($payed_to < $now) {
            $promo_to = new DateTimeImmutable("+ 1 month"); // +1М реклами
        }
        elseif ($payed_to >= $now) {
            $promo_to = $payed_to->modify("+ 1 month"); // додатково +1М реклами
        }

        dd($promo_to->format('d-m-y'));
        
        return view('buyAds', ['place' => $place]  );
    }

    public function payAds(Places $place ){
        $sum = -100;                    // ціна за місяць рекламних постерів
        $typeoperation = "buyAds";
        $comment = "за 1М реклами ".$place->name;

        $this->pay($place, $sum, $typeoperation, $comment);

        return redirect()->route('home');

    }

    public function pay (Places $place, $sum, $typeoperation, $comment) {
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
