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
        //dd($place);
        return view('dish_add', ['place'=>$place]);
    }

    // Зберігаєм страву з меню
    public function saveDish(Request $request){
        if(Auth::user()) {  //!!!! тут треба через Polices 

            $validatedData = $request->validate([
                'place_id'=>'required|integer|max:7000000',
                'dish_title'=>'required|string|min:2|max:100',
                'dish_group'=>'required|string|max:50',
                'description'=>'required|string|max:200',
                'portionweight'=>'required|integer|max:10000',
                'portioncost'=>'required|integer|max:10000',
                'image_file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ],
            [
                //required|string|min:2|max:100
                'dish_title.required' => ' Додайте "Назва страви"',
                'dish_title.string' => '"Назва страви" - string ',
                'dish_title.min' => '"Назва страви" - мінімум 2 символи',
                'dish_title.max' => '"Назва страви" - максимум 100 знаків',
                //
                'dish_group.required' => 'Група меню',
                // required|string|max:200 
                'description.required' => ' Додайте "Опис страви"',
                'description.string' => '"Опис страви" - це строка',
                'description.max' => '"Опис страви" - максимум 200 символів',
                // required|integer|max:6 
                'portionweight.required' => ' Додайте "Вагу порції"',
                'portionweight.integer' => '"Вага порції" - тільки цілі числа',
                'portionweight.max' => '"Вага порції" - максимум 10000',
                 // required|integer|max:6 
                'portioncost.required' => ' Додайте "Ціну порції"',
                'portioncost.integer' => '"Ціна порції" - тільки цілі числа',
                'portioncost.max' => '"Ціна порції" - максимум 10000',

                //required|image|mimes:jpg,png,jpeg,gif,svg|max:2048
                'image_file.required' => ' Додайте "Фото страви"',
                'image_file.image' => '"Фото страви" - файл зображення',
                'image_file.mimes' => '"Фото страви" - тільки jpg, jpeg, png, gif',
                'image_file.max' => '"Фото страви" - розмір максимум 2 Мб',             
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

        $validatedData = $request->validate([
                'dishid'=>'required|integer|max:7000000',
                'dishtitle'=>'required|string|min:2|max:100',
                'dishgroup'=>'required|string|max:50',
                'description'=>'required|string|max:200',
                'portionweight'=>'required|integer|max:10000',
                'portioncost'=>'required|integer|max:10000',
                'image_file' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ],
            [
                //required|string|min:2|max:100
                'dishtitle.required' => ' Додайте "Назва страви"',
                'dishtitle.string' => '"Назва страви" - string ',
                'dishtitle.min' => '"Назва страви" - мінімум 2 символи',
                'dishtitle.max' => '"Назва страви" - максимум 100 знаків',
                //
                'dishgroup.required' => 'Група меню',
                // required|string|max:200 
                'description.required' => ' Додайте "Опис страви"',
                'description.string' => '"Опис страви" - це строка',
                'description.max' => '"Опис страви" - максимум 200 символів',
                // required|integer|max:6 
                'portionweight.required' => ' Додайте "Вагу порції"',
                'portionweight.integer' => '"Вага порції" - тільки цілі числа',
                'portionweight.max' => '"Вага порції" - максимум 10000',
                 // required|integer|max:6 
                'portioncost.required' => ' Додайте "Ціну порції"',
                'portioncost.integer' => '"Ціна порції" - тільки цілі числа',
                'portioncost.max' => '"Ціна порції" - максимум 10000',

                //required|image|mimes:jpg,png,jpeg,gif,svg|max:2048
                //'image_file.required' => ' Додайте "Фото страви"',
                //'image_file.image' => '"Фото страви" - файл зображення',
                //'image_file.mimes' => '"Фото страви" - тільки jpg, jpeg, png, gif',
                //'image_file.max' => '"Фото страви" - розмір максимум 2 Мб',             
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
            'dishtitle'=> $request->dishtitle,
            'dishgroup'=> $request->dishgroup,
            'description'=> $request->description,
            'portionweight'=> $request->portionweight,
            'portioncost'=> $request->portioncost,
            'cost100g'=> $request->cost100g,
        ]);

        if(isset($fileNameWithExt)){
            $dishid->fill([
                'thumbnail'=>$fileNameWithExt,
            ]);
        }

        $result = $dishid->save();

        //видаляєм попереднє фото страви з диска
        if($result){
            $resldel = Storage::disk('public')->delete('images/dishes/'.$request->thumbnail); //для удаления файла из папки 
            //dd('images/places/'.$dishid->thumbnail);
            //dd($resldel);
        }

        //return redirect()->route('viewMenu',$request->dishid);
        return redirect()->route('viewMenu',$dishid->places_id);
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
