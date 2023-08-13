<?php

use Illuminate\Support\Facades\Route;

/*V*/
use App\Http\Controllers\PlacesController;  
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PlacesController::class, 'index'])->name('index'); //guests

Route::get('/menu/print', [PlacesController::class, 'printQR'])->name('printQRpage'); // guests

Route::get('/menu/{placeid}', [PlacesController::class, 'viewMenu'])->name('viewMenu'); // guests



Auth::routes();

// add new dish
Route::get('/home/newdish/{placeid}', [App\Http\Controllers\HomeController::class, 'formNewDish'])->name('dish.add');

//Route::post('/home', [App\Http\Controllers\HomeController::class, 'storeDish'])->name('dish.store');


// add new resto
Route::get('/home/add', [App\Http\Controllers\HomeController::class, 'formAddPlace'])->name('place_add');

Route::post('/home/store', [App\Http\Controllers\HomeController::class, 'storePlace'])->name('place.store');

//test
Route::post('/home/save', [App\Http\Controllers\HomeController::class, 'saveDish'])->name('dish.save');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
