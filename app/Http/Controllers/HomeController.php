<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTimeImmutable;

/*V*/
use Illuminate\Support\Facades\Auth; // підключаєм трейт фасад авторизації 
use Illuminate\Support\Facades\Storage;

use App\Models\Places;
use App\Models\Dish;  


 

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
        foreach($places as $place){
            $latestCoin = $place->coins()->orderBy('id','desc')->first('coins_after'); 
            if($latestCoin){  
                $place->coins=$latestCoin->coins_after;
            }
            else{
                $place->coins=0;
            }
        }
        //dd($places);

        return view('home', ['places'=> $places]);
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
                'description'=>'required|min:200|max:1000|',
                'manager'=>'required|min:9|max:16|',
                'viber'=>'required|min:9|max:16|',
                'telegram'=>'string|min:9|max:16|',
                //'email'=>'required|email:rfc,dns,spoof|min:6|max:100|',
                'sitplaces'=>'required|max:4|numeric',
                'delivery'=>'string',
                'wifipass'=>'string|max:30|',
                'phone1'=>'required|min:9|max:16|',
                'phone2'=>'string|min:9|max:16|',
                'phone3'=>'string|min:9|max:16|',
                'phone4'=>'string|min:9|max:16|',
                'insta'=>'string|min:4|max:100|',
                'facebook'=>'string|min:4|max:100|',
                'image_file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ],
            [
                'name.required' => ' Додайте "Назва закладу"',
                'name.max'=>'Назва закладу - максимум 100 знаків',

                'adress.required'  => 'Додайте "Адресу закладу"',
                'adress.min'  => '"Адреса закладу" - від 7 знаків',
                'adress.max'  => '"Адреса закладу" - до 100 знаків',

                'workhours.required' => 'Додайте "Розклад роботи"',
                'workhours.alpha_dash' => '"Розклад роботи" години у вигляді "9-18"',
                'workhours.min' => '"Розклад роботи" min 3 знаків у годинах "9-18"',
                'workhours.max' => '"Розклад роботи" max 6 знаків у годинах "9-18"',

                'description.required'=>'Додайте інформацію "Про заклад"',
                'description.string'=>'"Про заклад" - це строка',
                'description.min'=>'"Про заклад" - збільшіть опис до 200 знаків',
                'description.max'=>'"Про заклад" - зменшіть опис хоча б до 1000 знаків',

                'manager.string'=>'"Про заклад" - це строка',

                'viber.string'=>'"Про заклад" - це строка',

                'telegram.string'=>'"Про заклад" - це строка',

                'email.string'=>'"Про заклад" - це строка',

                'sitplaces.string'=>'"Про заклад" - це строка',

                'delivery.string'=>'"Про заклад" - це строка',

                'wifipass.string'=>'"Про заклад" - це строка',

                'phone1.string'=>'"Про заклад" - це строка',

                'phone2.string'=>'"Про заклад" - це строка',

                'phone3.string'=>'"Про заклад" - це строка',

                'phone4.string'=>'"Про заклад" - це строка',

                'insta.string'=>'"Про заклад" - це строка',
                'facebook.string'=>'"Про заклад" - це строка',
                'image_file.required'=>'"Про заклад" - це строка',

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

        $placeid->save();

        return redirect()->route('home');        
    }

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



}
