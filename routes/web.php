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

Route::get('/menu/print/{place}', [PlacesController::class, 'printQR'])->name('printQRpage'); // guests

Route::get('/menu/{place}', [PlacesController::class, 'viewMenu'])->name('viewMenu'); // guests

Route::get('/news', [PlacesController::class, 'allAds'])->name('newsAds'); // guests

Route::get('/news/{place}', [PlacesController::class, 'adsPlace'])->name('adsPlace'); // guests


Auth::routes();

/*Places*/
Route::get('/home/add', [App\Http\Controllers\HomeController::class, 'formAddPlace'])->name('place_add');
Route::post('/home/store', [App\Http\Controllers\HomeController::class, 'storePlace'])->name('place.store');
Route::get('/home/edit/{placeid}', [App\Http\Controllers\HomeController::class, 'formEditPlace'])->name('place.edit');
Route::patch('/home/edit/{placeid}', [App\Http\Controllers\HomeController::class, 'updatePlace'])->name('place.update');

Route::patch('/home/updImg/{placeid}', [App\Http\Controllers\HomeController::class, 'updatePlaceImage'])->name('place.updateImage');
Route::get('/home/delImg/{placeid}', [App\Http\Controllers\HomeController::class, 'deletePlaceImage'])->name('place.deleteImage');

/* Dishes */
Route::get('/home/editdish/{dishid}', [App\Http\Controllers\HomeController::class, 'formEditDish'])->name('dish.editdish');
Route::post('/home/upddish/{dishid}', [App\Http\Controllers\HomeController::class, 'updateDish'])->name('dish.updatedish');

Route::get('/home/delFormDish/{dish}', [App\Http\Controllers\HomeController::class, 'formDelDish'])->name('dish.formdeldish');
Route::delete('/home/delDish/{dish}', [App\Http\Controllers\HomeController::class, 'deleteDish'])->name('dish.delete');

Route::post('/home/updDishImg/{dishid}', [App\Http\Controllers\HomeController::class, 'updateDishImage'])->name('dish.updateDishImage');
Route::get('/home/delDishImg/{dishid}', [App\Http\Controllers\HomeController::class, 'deleteDishImage'])->name('dish.deleteDishImage');


// add new dish
Route::get('/home/newdish/{placeid}', [App\Http\Controllers\HomeController::class, 'formNewDish'])->name('dish.add');
Route::post('/home/save', [App\Http\Controllers\HomeController::class, 'saveDish'])->name('dish.save');


Route::get('/home/updish/{dish}', [App\Http\Controllers\HomeController::class, 'upDish'])->name('dish.up');
Route::get('/home/downdish/{dish}', [App\Http\Controllers\HomeController::class, 'downDish'])->name('dish.down');


// 
// Ads
Route::get('/myads/{place}', [App\Http\Controllers\AdsController::class, 'myAds'])->name('myads');
Route::get('/myads/newads/{place}', [App\Http\Controllers\AdsController::class, 'formNewAds'])->name('ads.new');
Route::post('/myads/saveads', [App\Http\Controllers\AdsController::class, 'saveNewAds'])->name('newads.save');





Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
