<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
                'image_file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

        if($request->hasFile('image_file')){
            #get original name file with extension
            $fileNameWithExt = $request->file('image_file')->getClientOriginalName(); // Exempl: "krah-bitkoin.jpg"
            $fileNameWithExt = str_replace(" ", "_", $fileNameWithExt); // замена пробелов(якщо є) на _

            #Uploading file - Загрузка файла в папку /storage
            $path = $request->file('image_file')->storeAs('public/images/places', $fileNameWithExt);//"krah-bitc_1691843459.jpg"
//          dd($path);
        }              

        Auth::user()->places()->create([
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

        return redirect()->route('home');
    }

    public function formEditPlace(Places $placeid) {

        //$places = Places::find($placeid)->get();
        //dd($placeid);

        return view('editPlace',['place'=>$placeid]);

    }

    public function updatePlace(Request $request,Places $placeid) {
        //dd($request);

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
