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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PlacesController::class, 'index'])->name('index');

Auth::routes();

// add new resto
Route::get('/home/add', [App\Http\Controllers\HomeController::class, 'formAddPlace'])->name('place.add');

Route::post('/home', [App\Http\Controllers\HomeController::class, 'storePlace'])->name('place.store');

// add new dish
Route::get('/home/newdish/{placeid}', [App\Http\Controllers\HomeController::class, 'formNewDish'])->name('dish.add');

Route::post('/home', [App\Http\Controllers\HomeController::class, 'storeDish'])->name('dish.store');





Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
