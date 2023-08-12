<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*V*/
use Illuminate\Support\Facades\Auth; // підключаєм трейт фасад авторизації 
use App\Models\Places;
use App\Models\Dish;  
use App\Models\Photo;  

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
        return view('home', ['places'=>Auth::user()->places()->latest()->get() ]);
    }

    public function formAddPlace(){
        return view('place_add');
    }

    public function storePlace(Request $request) {
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
            'fb'=> $request->fb
        ]);

        return redirect()->route('home');
    }

    public function formNewDish($placeid){
       return view('dish_add', ['placeid'=>$placeid]);
    }


    public function storeDish(Request $request){

        if(Auth::user()) {  //!!!! тут треба через Polices 

            Dish::create([
            'dishtitle'=> $request->dish_title,
            'dishgroup'=> $request->dish_group,
            'description'=> $request->description,
            'portionweight'=> $request->portionweight,
            'portioncost'=> $request->portioncost,
            'cost100g'=> $request->cost100g,
            'places_id'=> $request->places_id
            ]);

        return redirect()->route('viewMenu', $request->places_id);
        }
    
    }
}
