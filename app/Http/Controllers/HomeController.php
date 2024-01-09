<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTimeImmutable;

/*V*/
use Illuminate\Support\Facades\Auth; // підключаєм трейт фасад авторизації 
use Illuminate\Support\Facades\Storage;

use App\Models\Places;
use App\Models\Dish; 
use App\Models\Coins; 


 

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $places = Auth::user()->places()->latest()->get();
        $coins = Auth::user()->coins()->orderBy('id','desc')->first('coins_after');
        if($coins){
            $coin_sum = $coins->coins_after;
        }
        else {
            $coin_sum = 0;
        }

        foreach($places as $place){
            
            try{
                $now  = new DateTimeImmutable();  //obj "now"
                if($place->noadsto != null){
                    $payed_to = new DateTimeImmutable($place->noadsto);  //obj "2023-01-01"
                    if ($payed_to < $now){
                        $tarif['noadsto'] = false;
                    }
                    else{
                        $tarif['noadsto'] = true;
                    }
                }
                else{
                    $tarif['noadsto'] = false;
                }

                if($place->adsto != null){
                    $payed_to = new DateTimeImmutable($place->adsto);  //obj "2023-01-01"
                    if ($payed_to < $now){
                        $tarif['adsto'] = false;
                    }
                    else{
                        $tarif['adsto'] = true;
                    }
                }
                else{
                    $tarif['adsto'] = false;
                }

                if($place->positionto != null){
                    $payed_to = new DateTimeImmutable($place->positionto);  //obj "2023-01-01"
                    if ($payed_to < $now){
                        $tarif['positionto'] = false;
                    }
                    else{
                        $tarif['positionto'] = true;
                    }
                }
                else{
                    $tarif['positionto'] = false;
                }
            }
            catch(Exception $e){
                echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
            }
            $place->tarif=$tarif;
        }


        //dd($place->tarif['noadsto']);

        return view('home', ['places'=> $places, 'coins'=>$coin_sum ]);
    }

    public function formAddPlace(){
        return view('place_add');
    }

    public function storePlace(Request $request) {
        //dd($request);
        $validatedData = $request->validate([
                'name' =>'required|string|max:100|',
                'adress' =>'required|string|min:7|max:100|',
                'workhours'=>'required|alpha_dash|min:3|max:6|',
                'description'=>'required|string|min:50|max:1000|',
                'manager'=>'required|string|min:10|max:16|',
                'viber'=>'required|string|min:10|max:16|',
                'telegram'=>'nullable|string|min:3|max:16|',
                //'email'=>'required|email:rfc,dns,spoof|min:6|max:100|',
                'sitplaces'=>'nullable|integer|max:10000|',
                'delivery'=>'nullable|string|max:200|',
                'wifipass'=>'nullable|string|max:30|',
                'phone1'=>'required|min:10|max:16|',
                'phone2'=>'nullable|string|min:10|max:16|',
                'phone3'=>'nullable|string|min:10|max:16|',
                'phone4'=>'nullable|string|min:10|max:16|',
                'insta'=>'nullable|string|max:100|',
                'facebook'=>'nullable|string|max:100|',
                'image_file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ],
            [
                'name.required' => ' Додайте "Назва закладу"',
                'name.max'=>'Назва закладу - максимум 100 знаків',

                'adress.required'  => 'Додайте "Адресу закладу"',
                'adress.min'  => '"Адреса закладу" - від 7 знаків',
                'adress.max'  => '"Адреса закладу" - до 100 знаків',

                'workhours.required' => 'Додайте "Розклад роботи"',
                'workhours.alpha_dash' => '"Розклад роботи" години(без хвилин) у вигляді "9-18"',
                'workhours.min' => '"Розклад роботи" min 3 знаків у годинах "9-18"',
                'workhours.max' => '"Розклад роботи" max 6 знаків у годинах "9-18"',

                'description.required'=>'Додайте інформацію "Про заклад"',
                'description.string'=>'"Про заклад" - це строка',
                'description.min'=>'"Про заклад" - збільшіть опис від 50 знаків',
                'description.max'=>'"Про заклад" - зменшіть опис хоча б до 1000 знаків',

                'manager.string'=>'"Контакт менеджера" - це строка',
                'manager.min'=>'"Контакт менеджера" - мінімум 9 цифр(0674443311)',
                'manager.max'=>'"Контакт менеджера" - максимум 16 цифр',

                'viber.required'=>'Додайте телефон "Viber"',
                'viber.string'=>'"Viber" - це строка',
                'viber.min'=>'"Viber" - мінімум 9 цифр(0674443311)',
                'viber.max'=>'"Viber" - максимум 16 цифр',

                'telegram.string'=>'"Viber" - це строка',
                'telegram.min'=>'"Viber" - мінімум 3 знака',
                'telegram.max'=>'"Viber" - максимум 16 цифр',

                //required|email:rfc,dns,spoof|min:6|max:100|
                'email.required'=>'"Email" - обовязкове поле',
                'email.email.rfc'=>'"Email" - rfc',
                'email.email.dns'=>'"Email" - dns',
                'email.email.spoof'=>'"Email" - spoof',
                'email.min'=>'"Email" - занадто короткий',
                'email.max'=>'"Email" - max 100',

                // max:4|integer
                'sitplaces.string'=>'"Місць" - це строка',
                'sitplaces.max'=>'"Місць" - max 10000',
                'sitplaces.integer'=>'"Місць" - лише цілі цифри ',

                //string|max:200|
                'delivery.string'=>'"Доставка" - це строка',
                'delivery.max'=>'"Доставка" - максимум 200 знаків',

                // wifipass'=>'string|max:30|
                'wifipass.string'=>'"WіFі пароль" - це строка',
                'wifipass.max'=>'"WіFі пароль" - максимум 30 знаків',

                // required|min:10|max:16|
                'phone1.required'=>'Додайте "Основний телефон"',
                'phone1.string'=>'"Основний телефон" - це строка',
                'phone1.min'=>'"Основний телефон" - мінімум 10 цифр(0674443311)',
                'phone1.max'=>'"Основний телефон" - максимум 16 цифр',

                // phone2'=>'string|min:10|max:16|
                'phone2.string'=>'"Телефон 2" - це строка',
                'phone2.min'=>'"Телефон 2" - мінімум 10 цифр(0674443311)',
                'phone2.max'=>'"Телефон 2" - максимум 16 цифр',

                // phone3'=>'string|min:10|max:16|
                'phone3.string'=>'"Телефон 3" - це строка',
                'phone3.min'=>'"Телефон 3" - мінімум 10 цифр(0674443311)',
                'phone3.max'=>'"Телефон 3" - максимум 16 цифр',

                // phone4'=>'string|min:10|max:16|
                'phone4.string'=>'"Телефон 4" - це строка',
                'phone4.min'=>'"Телефон 4" - мінімум 10 цифр(0674443311)',
                'phone4.max'=>'"Телефон 4" - максимум 16 цифр',


                // string|min:10|max:100|
                'insta.string'=>'"Instagram" - це строка',
                'insta.max'=>'"Instagram" - максимум 100 знаків',

                // string|min:4|max:100|
                'facebook.string'=>'"Facebook" - це строка',
                'facebook.max'=>'"Facebook" - максимум 100 знаків ',

                'image_file.required'=>'Додайте фото закладу',
                //'image_file.image'=>'',
                'image_file.mimes'=>'формат Фото: jpg, png, jpeg',
                'image_file.max'=>'Розмір Фото: максимум 2мб',

        ]);

    

        if($request->hasFile('image_file')){
            #get original name file with extension
            $fileNameWithExt = $request->file('image_file')->getClientOriginalName(); // Exempl: "krah-bitkoin.jpg"
            $fileNameWithExt = str_replace(" ", "_", $fileNameWithExt); // замена пробелов(якщо є) на _

            $now  = new DateTimeImmutable();
            $now_str = $now->format("Y-m-d");
            $fileNameWithExt =$now_str . "_" . $fileNameWithExt; 


            #Uploading file - Загрузка файла в папку /storage
            $path = $request->file('image_file')->storeAs('public/images/places', $fileNameWithExt);//"krah-bitc_1691843459.jpg"
//          dd($path);
        }              

        $result = Auth::user()->places()->create([
            'name'=> $request->name,
            'adress'=> $request->adress,
            'workhours'=> $request->workhours,
            'description'=> $request->description,
            'sitplaces'=> $request->sitplaces,
            'delivery'=> $request->delivery,
            'wifipass'=>$request->wifipass,
            'manager'=> $request->manager,
            'phone1'=> $request->phone1,
            'phone2'=> $request->phone2,
            'phone3'=> $request->phone3,
            'phone4'=> $request->phone4,
            'email'=> $request->email,
            'viber'=> $request->viber,
            'telegram'=> $request->telegram,
            'insta'=> $request->insta,
            'fb'=> $request->facebook,
            'thumbnail'=>$fileNameWithExt,
        ]);


        // сповіщення в Телеграм про новий заклад
        if($result){
            /*  Telegram Notice */ 
            $botApiToken = env('TELEGRAM_BOT_TOKEN');
            //$channelId = 'your channel id';
            $channelId = '-1001890552528'; // @qr_menu_vn
            //$channelId = "@menu_adm_notice";
            $text = 'New place:'.$request->name ."; Adress:".$request->adress.", Manager tel:".$request->manager;
            $query = http_build_query([
                'chat_id' => $channelId,
                'text' => $text,
            ]);
            $url = "https://api.telegram.org/bot{$botApiToken}/sendMessage?{$query}";
            ($url);
            file_get_contents($url);
        }

        return redirect()->route('place.toModer');
    }

    public function formEditPlace(Places $placeid) {

        //$places = Places::find($placeid)->get();
        //dd($placeid);

        return view('editPlace',['place'=>$placeid]);

    }

    public function updatePlace(Request $request,Places $placeid) {
        //dd($request);
        //$this->authorize('updatePlace', $placeid);

        $validatedData = $request->validate([
                'name' =>'required|string|max:100|',
                'adress' =>'required|string|min:7|max:100|',
                'workhours'=>'required|alpha_dash|min:3|max:6|',
                'description'=>'required|string|min:200|max:1500|',
                'manager'=>'required|string|min:10|max:16|',
                'viber'=>'required|string|min:10|max:16|',
                'telegram'=>'nullable|string|min:3|max:16|',
                //'email'=>'required|email:rfc,dns,spoof|min:6|max:100|',
                'sitplaces'=>'nullable|integer|max:10000|',
                'delivery'=>'nullable|string|max:200|',
                'wifipass'=>'nullable|string|max:30|',
                'phone1'=>'required|min:10|max:16|',
                'phone2'=>'nullable|string|min:10|max:16|',
                'phone3'=>'nullable|string|min:10|max:16|',
                'phone4'=>'nullable|string|min:10|max:16|',
                'insta'=>'nullable|string|max:100|',
                'fb'=>'nullable|string|max:100|',
                'disabled'=>'required|integer|min:0|max:1',
                'image_file' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ],
            [
                'name.required' => ' Додайте "Назва закладу"',
                'name.max'=>'Назва закладу - максимум 100 знаків',

                'adress.required'  => 'Додайте "Адресу закладу"',
                'adress.min'  => '"Адреса закладу" - від 7 знаків',
                'adress.max'  => '"Адреса закладу" - до 100 знаків',

                'workhours.required' => 'Додайте "Розклад роботи"',
                'workhours.alpha_dash' => '"Розклад роботи" години(без хвилин) у вигляді "9-18"',
                'workhours.min' => '"Розклад роботи" min 3 знаків у годинах "9-18"',
                'workhours.max' => '"Розклад роботи" max 6 знаків у годинах "9-18"',

                'description.required'=>'Додайте інформацію "Про заклад"',
                'description.string'=>'"Про заклад" - це строка',
                'description.min'=>'"Про заклад" - збільшіть опис до 200 знаків',
                'description.max'=>'"Про заклад" - зменшіть опис хоча б до 1000 знаків',

                'manager.string'=>'"Контакт менеджера" - це строка',
                'manager.min'=>'"Контакт менеджера" - мінімум 9 цифр(0674443311)',
                'manager.max'=>'"Контакт менеджера" - максимум 16 цифр',

                'viber.required'=>'Додайте телефон "Viber"',
                'viber.string'=>'"Viber" - це строка',
                'viber.min'=>'"Viber" - мінімум 9 цифр(0674443311)',
                'viber.max'=>'"Viber" - максимум 16 цифр',

                'telegram.string'=>'"Viber" - це строка',
                'telegram.min'=>'"Viber" - мінімум 3 знака',
                'telegram.max'=>'"Viber" - максимум 16 цифр',

                //required|email:rfc,dns,spoof|min:6|max:100|
                'email.required'=>'"Email" - обовязкове поле',
                'email.email.rfc'=>'"Email" - rfc',
                'email.email.dns'=>'"Email" - dns',
                'email.email.spoof'=>'"Email" - spoof',
                'email.min'=>'"Email" - занадто короткий',
                'email.max'=>'"Email" - max 100',

                // max:4|integer
                'sitplaces.string'=>'"Місць" - це строка',
                'sitplaces.max'=>'"Місць" - max 10000',
                'sitplaces.integer'=>'"Місць" - лише цілі цифри ',

                //string|max:200|
                'delivery.string'=>'"Доставка" - це строка',
                'delivery.max'=>'"Доставка" - максимум 200 знаків',

                // wifipass'=>'string|max:30|
                'wifipass.string'=>'"WіFі пароль" - це строка',
                'wifipass.max'=>'"WіFі пароль" - максимум 30 знаків',

                // required|min:10|max:16|
                'phone1.required'=>'Додайте "Основний телефон"',
                'phone1.string'=>'"Основний телефон" - це строка',
                'phone1.min'=>'"Основний телефон" - мінімум 10 цифр(0674443311)',
                'phone1.max'=>'"Основний телефон" - максимум 16 цифр',

                // phone2'=>'string|min:10|max:16|
                'phone2.string'=>'"Телефон 2" - це строка',
                'phone2.min'=>'"Телефон 2" - мінімум 10 цифр(0674443311)',
                'phone2.max'=>'"Телефон 2" - максимум 16 цифр',

                // phone3'=>'string|min:10|max:16|
                'phone3.string'=>'"Телефон 3" - це строка',
                'phone3.min'=>'"Телефон 3" - мінімум 10 цифр(0674443311)',
                'phone3.max'=>'"Телефон 3" - максимум 16 цифр',

                // phone4'=>'string|min:10|max:16|
                'phone4.string'=>'"Телефон 4" - це строка',
                'phone4.min'=>'"Телефон 4" - мінімум 10 цифр(0674443311)',
                'phone4.max'=>'"Телефон 4" - максимум 16 цифр',


                // string|min:10|max:100|
                'insta.string'=>'"Instagram" - це строка',
                'insta.max'=>'"Instagram" - максимум 100 знаків',

                // string|min:4|max:100|
                'fb.string'=>'"Facebook" - це строка',
                'fb.max'=>'"Facebook" - максимум 100 знаків ',

                //required|integer|min:0|max:1
                'disabled.required'=>'disabled required',
                'disabled.integer'=>'disabled integer',
                'disabled.min'=>'disabled min',
                'disabled.max'=>'disabled max',

                'image_file.image'=>'Image format',
                'image_file.mimes'=>'формат Фото: jpg, png, jpeg',
                'image_file.max'=>'Розмір Фото: максимум 2мб',

        ]);


        if($request->hasFile('image_file')){
            #get original name file with extension
            $fileNameWithExt = $request->file('image_file')->getClientOriginalName(); // Exempl: "krah-bitkoin.jpg"
            $fileNameWithExt = str_replace(" ", "_", $fileNameWithExt); // замена пробелов(якщо є) на _

            //унікалізація імені файла
            $now  = new DateTimeImmutable();
            $now_str = $now->format("Y-m-d");
            $fileNameWithExt =$now_str . "_" . $fileNameWithExt; 

            #Uploading file - Загрузка файла в папку /storage
            $path = $request->file('image_file')->storeAs('public/images/places', $fileNameWithExt);//"krah-bitc_1691843459.jpg"
//          dd($path);
        }



        $placeid->fill([
            'name'=> $request->name,
            'adress'=> $request->adress,
            'workhours'=> $request->workhours,
            'description'=> $request->description,
            'sitplaces'=> $request->sitplaces,
            'delivery'=> $request->delivery,
            'wifipass'=>$request->wifipass,
            'manager'=> $request->manager,
            'phone1'=> $request->phone1,
            'phone2'=> $request->phone2,
            'phone3'=> $request->phone3,
            'phone4'=> $request->phone4,
            'email'=> $request->email,
            'viber'=> $request->viber,
            'telegram'=> $request->telegram,
            'insta'=> $request->insta,
            'fb'=> $request->fb,
            'disabled' => $request->disabled, 
        ]);
        if(isset($fileNameWithExt)){
            $placeid->fill([
            'thumbnail'=>$fileNameWithExt,
        ]);
        }

        $result = $placeid->save();

        // delete old imgage from disk
        if($result){
            $resldel = Storage::disk('public')->delete('images/places/'.$request->thumbnail); //для удаления файла из папки 
            //dd('images/places/'.$placeid->thumbnail);
            //dd($resldel);
        }

        return redirect()->route('home');        
    }

    /*
    // update image
    public function updatePlaceImage(Request $request,Places $placeid) {
        $validatedData = $request->validate([
                'image_file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

        if($request->hasFile('image_file')){
            #get original name file with extension
            $fileNameWithExt = $request->file('image_file')->getClientOriginalName(); // Exempl: "krah-bitkoin.jpg"
            $fileNameWithExt = str_replace(" ", "_", $fileNameWithExt); // замена пробелов(якщо є) на _

            //унікалізація імені файла
            $now  = new DateTimeImmutable();
            $now_str = $now->format("Y-m-d");
            $fileNameWithExt =$now_str . "_" . $fileNameWithExt; 

            #Uploading file - Загрузка файла в папку /storage
            $path = $request->file('image_file')->storeAs('public/images/places', $fileNameWithExt);//"krah-bitc_1691843459.jpg"
//          dd($path);
        }

        $placeid->fill([
            'thumbnail'=>$fileNameWithExt,
        ]);

        $result = $placeid->save();
        if($result){
            $resldel = Storage::disk('public')->delete('images/places/'.$request->thumbnail); //для удаления файла из папки 
            //dd('images/places/'.$placeid->thumbnail);
            //dd($resldel);
        }

        return redirect()->route('home');         

    }

    */

    /*
    // delete image
    public function deletePlaceImage(Places $placeid) {
    
        $result = $placeid->fill([
            'thumbnail'=>"",
        ]);
        if($result){
            $oneplace = Places::find($placeid);
            //dd($oneplace[0]->thumbnail);
            Storage::disk('public')->delete('images/places/'.$oneplace[0]->thumbnail); //для удаления файла из папки 
        }
    
        return redirect()->route('home');
    }
    */

    // buymeacoffe
    // /bmac/pay/aaa 
    public function payBMAC ($sum){
        //dd($request);
        $idUser = Auth::user()->id;

        $lastpay = Coins::where('user_id', $idUser)->orderBy('id','desc')->first('coins_after');
        //dd($lastpay );

        if($lastpay == null){
            $coins_before = 0;
        }
        else{
            $coins_before = $lastpay->coins_after;
        }
        
        $comment = "+ $".$sum." bmac";

        //dd($coins_before, $sum);

        
        $coins = new Coins();
        $coins->fill([
            'coins_before' => intval($coins_before),     // 0
            'operation_sum' => intval($sum),    // 10
            'coins_after' => $coins_before + $sum,      // before+sum
            'user_id' => Auth::user()->id,      // Auth::user->id
            'typeoperation'=> "add",    // "add"
            'comment' => $comment,          // "поповнення"
            'places_id' => 0 // default for BMAC
        ]);
        $coins->save();

        
    }

    public function pay5usd(){
        $this->payBMAC(5);
        return redirect()->route('home');
    }

    public function pay15usd(){
        $this->payBMAC(16);
        return redirect()->route('home');
    }

    public function pay50usd(){
        $this->payBMAC(50);
        return redirect()->route('home');
    }

    public function pay100usd(){
        $this->payBMAC(100);
        return redirect()->route('home');
    }

    public function pay200usd(){
        $this->payBMAC(200);
        return redirect()->route('home');
    }


}
