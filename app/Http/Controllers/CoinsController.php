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
        //dd($request);
        $validatedData = $request->validate([
            'tariff' => 'required',
        ]);
        switch($request->tariff){
            case 'start1m':
                $result = $this->pay($place, -5, "start1m", "1m ".$place->name);
                if($result){
                    $setNoAds = $this->setNoAds($place,'m1'); // places.
                    return redirect()->route('home');
                }
                else{
                    return view('pageNoCoins', ['place' => $place]); // сторінка "Недостатньо коштів"
                }
                break;
            case 'start12m':
                $result = $this->pay($place, -49, "start1m", "12m ".$place->name);
                if($result){
                    $setNoAds = $this->setNoAds($place,'m12'); // places.
                    return redirect()->route('home');
                }
                else{
                    return view('pageNoCoins', ['place' => $place]); // сторінка "Недостатньо коштів"
                }
                break;
            case 'standart1m':
                $result = $this->pay($place, -10, "standart1m", "1m ".$place->name);
                if($result){
                    $setNoAds = $this->setNoAds($place,'m1'); // places.
                    $setPromo = $this->addPromo($place,'m1'); // places.
                    return redirect()->route('home');
                }
                else{
                    return view('pageNoCoins', ['place' => $place]); // сторінка "Недостатньо коштів"
                }
                break;
            case 'standart12m':
                $result = $this->pay($place, -99, "standart12m", "12m ".$place->name);
                if($result){
                    $setNoAds = $this->setNoAds($place,'m12'); // places.
                    $setPromo = $this->addPromo($place,'m12'); // places.
                    return redirect()->route('home');
                }
                else{
                    return view('pageNoCoins', ['place' => $place]); // сторінка "Недостатньо коштів"
                }
                break;
            case 'premium1m':
                $result = $this->pay($place, -25, "premium1m", "1m ".$place->name);
                if($result){
                    $setNoAds = $this->setNoAds($place,'m1'); // places.
                    $setPromo = $this->addPromo($place,'m1'); // places.
                    $setPromo = $this->upTop($place,'m1'); // places.

                    return redirect()->route('home');
                }
                else{
                    return view('pageNoCoins', ['place' => $place]); // сторінка "Недостатньо коштів"
                }
                break;
            case 'premium12m':
                $result = $this->pay($place, -199, "premium12m", "12m ".$place->name);
                if($result){
                    $setNoAds = $this->setNoAds($place,'m12'); // places.
                    $setPromo = $this->addPromo($place,'m12'); // places.
                    $setPromo = $this->upTop($place,'m12'); // places.
                    return redirect()->route('home');
                }
                else{
                    return view('pageNoCoins', ['place' => $place]); // сторінка "Недостатньо коштів"
                }
                break;
            default:
                //dd('noone tariff selected');
                return view ('home');
                break;    
        }    
    }


    private function setNoAds(Places $place, $period ){
        try{
            if(!empty($period)){
                $this->storeDate($place, 'noads', $period); // до якої дати буде діяти  
            }
        }
        catch(Exception $e){
                echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
            }
    }


    private function addPromo(Places $place, $period ){
        try{
            if(!empty($period)){
                $this->storeDate($place, 'promoto', $period); // до якої дати буде діяти  
            }
        }
        catch(Exception $e){
                echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
            }
    }

    private function upTop(Places $place, $period ){
        try{
            if(!empty($period)){
                $this->storeDate($place, 'toplist', $period); // до якої дати буде діяти
                $place->position = 1;
                $place->save();  
            }
        }
        catch(Exception $e){
                echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
            }
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

        $lastpay = Auth::user()->coins()->orderBy('id','desc')->first('coins_after');
        //dd($lastpay);

        if($lastpay == null || $lastpay->coins_after+$sum < 0){
            //dd('nomoney');
            return false; // flag to show "noMoney" page
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
        return $result;
    }



    public function pageNoCoins(Places $place){
        return view ('pageNoCoins', ['place'=>$place]);
    } 


}
