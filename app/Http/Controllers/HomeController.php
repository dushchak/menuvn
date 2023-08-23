<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*V*/
use Illuminate\Support\Facades\Auth; // підключаєм трейт фасад авторизації 
use Illuminate\Support\Facades\Storage;

use App\Models\Places;
use App\Models\Dish;  
use App\Models\Photo; 
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

        $placeid->fill([
            'name'=> $request->name,
            'adress'=> $request->adress,
            'workhours'=> $request->workhours,
            'description'=> $request->description,
            'sitplaces'=> $request->sitplaces,
            'delivery'=> $request->delivery,
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






    public function formNewDish($placeid){
       return view('dish_add', ['placeid'=>$placeid]);
    }

    // Зберігаєм страву з меню
    public function saveDish(Request $request){

        if(Auth::user()) {  //!!!! тут треба через Polices 

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
                $path = $request->file('image_file')->storeAs('public/images/dishes', $fileNameWithExt);//"krah-bitcoina_1691843459.jpg"
//                dd($path);
            }    

            // створюємо обєкт одного закладу = place_id
            //$place = Places::find(['id'=>$request->places_id]);
            $place = Places::firstOrNew(['id'=>$request->places_id]);
            /* викликаємо метод "прямогозвязку" методом dishes()
             який автоматом додає в таблицю БД - "place_id"
             */
            $place->dishes()->create([
                'dishtitle'=> $request->dish_title,
                'dishgroup'=> $request->dish_group,
                'description'=> $request->description,
                'portionweight'=> $request->portionweight,
                'portioncost'=> $request->portioncost,
                'cost100g'=> $request->cost100g,
                'thumbnail' => $fileNameWithExt, 
            ]);

        return redirect()->route('viewMenu', $request->places_id);
        }
    
    }


    public function formEditDish(Dish $dishid) {

        //$places = Places::find($placeid)->get();
        //dd($dishid);

        return view('editDish',['dish'=>$dishid]);

    }

    public function updateDish (Request $request,Dish $dishid){
        $dishid->fill([
            'dishtitle'=> $request->dishtitle,
            'dishgroup'=> $request->dishgroup,
            'description'=> $request->description,
            'portionweight'=> $request->portionweight,
            'portioncost'=> $request->portioncost,
            'cost100g'=> $request->cost100g,
        ]);

        $dishid->save();

        //return redirect()->route('viewMenu',$request->dishid);
        return redirect()->route('viewMenu',$dishid->places_id);
    }


    public function updateDishImage(Request $request,Dish $dishid) {
        //dd($dishid);
        $validatedData = $request->validate([
                'image_file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

        if($request->hasFile('image_file')){
            #get original name file with extension
            $fileNameWithExt = $request->file('image_file')->getClientOriginalName(); // Exempl: "krah-bitkoin.jpg"
            $fileNameWithExt = str_replace(" ", "_", $fileNameWithExt); // замена пробелов(якщо є) на _

            #Uploading file - Загрузка файла в папку /storage
            $path = $request->file('image_file')->storeAs('public/images/dishes', $fileNameWithExt);//"krah-bitc_1691843459.jpg"
//          dd($path);
        }

        $dishid->fill([
            'thumbnail'=>$fileNameWithExt,
        ]);
        $result = $dishid->save();
        
        if($result){
            $resldel = Storage::disk('public')->delete('images/dishes/'.$request->thumbnail); //для удаления файла из папки 
            //dd('images/places/'.$dishid->thumbnail);
            //dd($resldel);
        }

        
        return redirect()->route('viewMenu',$dishid->places_id);         

    }

    //deleteDishImage
    public function deleteDishImage(Dish $dishid) {
    
        $result = $dishid->fill([
            'thumbnail'=>"",
        ]);
        if($result){
            $dish = Dish::find($dishid);
            //dd($dish[0]->thumbnail);
            $test = Storage::disk('public')->delete('images/dishes/'.$dish[0]->thumbnail); //для удаления файла из папки 
            
        }
    
        //return redirect()->route('home');
        return redirect()->route('viewMenu',$dishid);         
    }

    public function formDelDish(Dish $dish) {
        return view('formDeleteDish', ['dish'=>$dish]);

    }

    public function deleteDish(Dish $dish){
        //dd($dish);
        $result = $dish->delete();
        if($result){
            $test = Storage::disk('public')->delete('images/dishes/'.$dish->thumbnail); //для удаления файла из папки
            //dd($test);
        }
        
        return redirect()->route('viewMenu',$dish->places_id);    
    }


    public function upDish(Dish $dish) {
        //dd("$dish");
        $pos = $dish->position;
        if($pos < 120){
            $dish->fill(['position' => $pos+1]);
            $dish->save();
        }
        
        return redirect()->route('viewMenu',$dish->places_id);  
    }

    public function downDish(Dish $dish) {
        //dd("$dish");
        $pos = $dish->position;
        if($pos > 1 ){
            $dish->fill(['position' => 1]);
            $dish->save();
        }
        
        return redirect()->route('viewMenu', $dish->places_id );  
    }
}
