<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Places;

/*V*/
use Illuminate\Support\Facades\Auth; // підключаєм трейт фасад авторизації 

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('can:admin-panel');
    }

    public function index (){
        $places = Places::where('moderate', 0)->orderBy('position','desc')->get();

        $newplaces = Places::where('moderate', 0)->orderBy('position','desc')->get();

        //dd($places);
        
        return view('indexAdmin', ['places' => $places, 'newplaces' => $newplaces]);
    }

    public function moderatePlace(Request $request,Places $place){

        $place->fill([
            'moderate'=>1,
        ]);
        $result = $place->save();

        $newplaces = Places::where('moderate', 0)->orderBy('position','desc')->get();
        $places = Places::where('moderate', 1)->orderBy('position','desc')->get();

        return view('indexAdmin', ['places' => $places, 'newplaces' => $newplaces]);
    }

    public function blockPlace(Request $request,Places $place){

        $place->fill([
            'moderate'=>0,
        ]);
        $result = $place->save();

        $newplaces = Places::where('moderate', 0)->orderBy('position','desc')->get();
        $places = Places::where('moderate', 1)->orderBy('position','desc')->get();
        
        return view('indexAdmin',  ['places' => $places, 'newplaces' => $newplaces]  );
    }
}
