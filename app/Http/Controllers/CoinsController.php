<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth');
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

    public function payAds (Request $request, Places $place) {
        //dd($place, $request);

        switch ($request->typeoperation) {
            case 'buyads':
                $sum = -100;
                break;
            default:
                $sum = 0;
                break;
        }

        $lastpay = $place->coins()->orderBy('id','desc')->first('coins_after')   ; // залишок на рахунку в останній операції
        //dd($lastpay);
        if($lastpay == null || $lastpay->coins_after == 0){
            return redirect()->route('home'); // сторінка "Недостатньо коштів"
        }
        elseif ($lastpay->coins_after+$sum <= 0) {
            return redirect()->route('home'); // сторінка "Недостатньо коштів"
        }
        else{
            $coins_before = $lastpay->coins_after;
        }
        $comment = "за рекламу ".$place->name;

        $coins = new Coins();
        $coins->fill([
            'coins_before' => intval($coins_before),     // 0
            'operation_sum' => intval($sum),    // 10
            'coins_after' => $coins_before + $sum,      // before+sum
            'operator_id' => Auth::user()->id,      // Auth::user->id
            'typeoperation'=> "buyAds",    // "add"
            'comment' => $comment,          // "поповнення"
        ]);
        $place->coins()->save($coins);

        return redirect()->route('home');
    }
}
