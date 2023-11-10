<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*V*/
use Illuminate\Support\Facades\Auth; // підключаєм трейт фасад авторизації 
use Illuminate\Support\Facades\Storage;

use App\Models\Places;
use App\Models\Dish;

class DishesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function formNewDish(Places $place){
       return view('dish_add', ['place'=>$place]);
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

            // створюємо обєкт одного закладу = place
            $place = Places::firstOrNew(['id'=>$request->place_id]);

            /* викликаємо метод "прямогозвязку" методом dishes()
             який автоматом додає в таблицю БД - "place_id"
             */
            $place->dishes()->create([
                'dishtitle'=> $request->dish_title,
                'dishgroup'=> $request->dish_group,
                'description'=> $request->description,
                'portionweight'=> $request->portionweight,
                'portioncost'=> $request->portioncost,
                'thumbnail' => $fileNameWithExt, 
            ]);

        return redirect()->route('viewMenu', $request->place_id);
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
