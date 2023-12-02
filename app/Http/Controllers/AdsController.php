<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // підключаєм трейт фасад авторизації 
use Illuminate\Support\Facades\Storage;  // для зберігання і видалення зображень на диску

use App\Models\Places;
use App\Models\Ads;


class AdsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function formNewAds(Places $place){
        return view('formNewAds', ['place'=>$place] );
    }

    public function saveNewAds(Request $request, Places $place){
        //dd($request);

        if(Auth::user()) {  //!!!! тут треба через Polices ????
            $validatedData = $request->validate([
                'image_file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if($request->hasFile('image_file')){
                #get original name file with extension
                $fileNameWithExt = $request->file('image_file')->getClientOriginalName(); // Exempl: "krah-bitkoin.jpg"
                $fileNameWithExt = str_replace(" ", "_", $fileNameWithExt); // замена пробелов(якщо є) на _   

                # file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);     // "krah-bitkoin"
                
                # file extension like ".jpg"
                $extension = $request->file('image_file')->getClientOriginalExtension();  // ".jpg"
                
                #   new name з Unixtime з розширенням 
                $newName = $fileName."_".time().".".$extension;  // krah-bitkoin_2023-08-12.jpg
                
                #Uploading file - Загрузка файла в папку /storage
                $path = $request->file('image_file')->storeAs('public/images/ads', $fileNameWithExt);//"krah-bitcoina_1691843459.jpg"
//                dd($path);
            }    

            // 
            $place = Places::firstOrNew(['id'=>$request->place_id]);
            /* викликаємо метод "прямогозвязку" методом dishes()
             який автоматом додає в таблицю БД - "place_id"
             */
            $place->ads()->create([
                            'title'=> $request->title,
                            'description'=> $request->description,
                            'typeads'=> 1,
                            'moderate'=> 0,
                            'img' => $fileNameWithExt, 
            ]);

        //return redirect()->route('home');
        return redirect()->route('placeAds', $request->place_id);
        }
    
    }

    public function formEditAds(Ads $ads , Places $place){
        //dd($place);
        return view('formEditAds', ['ads'=>$ads, 'place'=>$place] );
    }

    public function updateAds (Request $request, Ads $ads){
        //dd($request);

        if(Auth::user()) {  //!!!! тут треба через Polices

            if($request->hasFile('image_file')){
                #get original name file with extension
                $fileNameWithExt = $request->file('image_file')->getClientOriginalName(); // Exempl: "krah-bitkoin.jpg"
                $fileNameWithExt = str_replace(" ", "_", $fileNameWithExt); // замена пробелов(якщо є) на _   
                # file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);     // "krah-bitkoin"
                # file extension like ".jpg"
                $extension = $request->file('image_file')->getClientOriginalExtension();  // ".jpg"
                #   new name з Unixtime з розширенням 
                $newName = $fileName."_".time().".".$extension;  // krah-bitkoin_2023-08-12.jpg
                #Uploading file - Загрузка файла в папку /storage
                $path = $request->file('image_file')->storeAs('public/images/ads', $fileNameWithExt);//"someimg.jpg"
//                dd($path);
                if($path){ // якщо збереглось - удаляем старе img
                    $resldel = Storage::disk('public')->delete('images/ads/'.$ads->img); //для удаления файла из папки 
                    //dd('images/places/'.$dishid->thumbnail);
                    //dd($resldel);
                }
                $ads->fill([
                    'img' => $fileNameWithExt,
                ]);
                
        }
                  
            }  

            $ads->fill([
                'title'=>$request->title,
                'description'=>$request->description,
                //'img',
                'typeads'=>1,
            ]);
            $ads->save();

            return redirect()->route('placeAds', $ads->places_id );
    }


     public function deleteAds(Ads $ads){
        //dd($dish);
        $result = $ads->delete();
        if($result){
            $test = Storage::disk('public')->delete('images/ads/'.$ads->img); //для удаления файла из папки
            //dd($test);
        }
        
        return redirect()->route('placeAds', $ads->places_id );  
    }

    public function selectPlaceAdv(){
        $places = Auth::user()->places()->latest()->get();

        //dd($places);
        return view('listPlacesNewAdv',['places'=>$places]);
    }
}
