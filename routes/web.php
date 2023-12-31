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
Route::get('/viewplace/{place}', [PlacesController::class, 'viewPlace'])->name('place.view'); //guests


Route::get('/menu/print/{place}', [PlacesController::class, 'printQR'])->name('printQRpage'); // guests
Route::post('/menu/qrstyle/{place}', [PlacesController::class, 'printQRstyle'])->name('printQRstyle'); // guests

Route::get('/menu/{place}', [PlacesController::class, 'viewMenu'])->name('viewMenu'); // guests
Route::get('/news', [PlacesController::class, 'allAds'])->name('newsAds'); // guests



Auth::routes();

/*Places*/
Route::get('/home/add', [App\Http\Controllers\HomeController::class, 'formAddPlace'])->name('place_add');
Route::post('/home/store', [App\Http\Controllers\HomeController::class, 'storePlace'])->name('place.store');
Route::get('home/tomoder', function(){ 	return view('pageToModer'); })->name('place.toModer');
Route::get('/home/edit/{placeid}', [App\Http\Controllers\HomeController::class, 'formEditPlace'])->name('place.edit')->middleware('can:updatePlace,placeid');

Route::patch('/home/edit/{placeid}', [App\Http\Controllers\HomeController::class, 'updatePlace'])->name('place.update')->middleware('can:updatePlace,placeid');

Route::patch('/home/updImg/{placeid}', [App\Http\Controllers\HomeController::class, 'updatePlaceImage'])->name('place.updateImage')->middleware('can:updatePlaceImage,placeid');
Route::get('/home/delImg/{placeid}', [App\Http\Controllers\HomeController::class, 'deletePlaceImage'])->name('place.deleteImage')->middleware('can:deletePlaceImage,placeid'); 





/* Dishes */
Route::get('/home/editdish/{dishid}', [App\Http\Controllers\DishesController::class, 'formEditDish'])->name('dish.editdish');
Route::post('/home/upddish/{dishid}', [App\Http\Controllers\DishesController::class, 'updateDish'])->name('dish.updatedish');

Route::get('/home/delFormDish/{dish}', [App\Http\Controllers\DishesController::class, 'formDelDish'])->name('dish.formdeldish');
Route::delete('/home/delDish/{dish}', [App\Http\Controllers\DishesController::class, 'deleteDish'])->name('dish.delete');

Route::post('/home/updDishImg/{dishid}', [App\Http\Controllers\DishesController::class, 'updateDishImage'])->name('dish.updateDishImage');
Route::get('/home/delDishImg/{dishid}', [App\Http\Controllers\DishesController::class, 'deleteDishImage'])->name('dish.deleteDishImage');




// Dishes
Route::get('/home/newdish/{place}', [App\Http\Controllers\DishesController::class, 'formNewDish'])->name('dish.add')
->middleware('can:updatePlace,place');
//->middleware('can:addDish,place');

Route::post('/home/save', [App\Http\Controllers\DishesController::class, 'saveDish'])->name('dish.save');


Route::get('/home/updish/{dish}', [App\Http\Controllers\DishesController::class, 'upDish'])->name('dish.up');
Route::get('/home/downdish/{dish}', [App\Http\Controllers\DishesController::class, 'downDish'])->name('dish.down');


// 
// Ads
Route::get('/placeads/{place}', [App\Http\Controllers\PlacesController::class, 'placeAds'])->name('placeAds');

Route::get('/placeads/newads/{place}', [App\Http\Controllers\AdsController::class, 'formNewAds'])
	->middleware('can:newAdv,place')
	->name('ads.new');

Route::post('/placeads/saveads', [App\Http\Controllers\AdsController::class, 'saveNewAds'])->name('newads.save');

Route::get('/placeads/editads/{ads}/{place}', [App\Http\Controllers\AdsController::class, 'formEditAds'])->name('ads.editform')->middleware('can:editformAds,ads,place');

Route::post('/placeads/update/{ads}/{place}', [App\Http\Controllers\AdsController::class, 'updateAds'])->name('ads.update')->middleware('can:editAds,ads,place');
Route::get('/placeads/delete/{ads}', [App\Http\Controllers\AdsController::class, 'deleteAds'])
	->middleware('can:deleteAds,ads,place')
	->name('ads.delete');

Route::get('/myads/places', [App\Http\Controllers\AdsController::class, 'selectPlaceAdv'])->name('ads.listPlaces'); // сторінка вибору Закладу -> new Adv



// Coins

Route::post('/wallet/nocoins/{place}', [App\Http\Controllers\CoinsController::class, 'pageNoCoins'])->name('coins.nocoins');
Route::get('/wallet/addForm/{place}', [App\Http\Controllers\CoinsController::class, 'formAddConis'])->name('coins.formAdd');
Route::post('/wallet/add/{place}', [App\Http\Controllers\CoinsController::class, 'addCoins'])->name('coins.add'); // добавить монет

Route::get('/wallet/buyads/{place}', [App\Http\Controllers\CoinsController::class, 'formBuyAds'])->name('coins.buyads')->middleware('can:updatePlace,place');

Route::post('/wallet/payads/{place}', [App\Http\Controllers\CoinsController::class, 'payPromo'])->name('coins.payads')->middleware('can:updatePlace,place');

Route::get('/wallet/formnoads/{place}', [App\Http\Controllers\CoinsController::class, 'formNoAds'])->name('coins.formNoAds')->middleware('can:updatePlace,place') ;
Route::post('/wallet/noads/{place}', [App\Http\Controllers\CoinsController::class, 'payNoAds'])->name('coins.noads1m')->middleware('can:updatePlace,place');

Route::get('/wallet/formup/{place}', [App\Http\Controllers\CoinsController::class, 'formUpPlace'])->name('coins.formUp')->middleware('can:updatePlace,place');

Route::post('/wallet/storeUp/{place}', [App\Http\Controllers\CoinsController::class, 'upTop'])->name('coins.storeUp')->middleware('can:updatePlace,place');

/// BuyMeACoffe payment 
/// HomeController (auth) 
Route::get('/bmac/pay/aaa', [App\Http\Controllers\HomeController::class, 'pay5usd'])->name('pay5')->middleware('auth');


// Admin
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('adminpanel');
Route::get('/admin/moderate/{place}', [App\Http\Controllers\AdminController::class, 'moderatePlace'])->name('admin.moderate');
Route::get('/admin/block/{place}', [App\Http\Controllers\AdminController::class, 'blockPlace'])->name('admin.blockPlace');
/*
## Доступ перевіряється в самому контроллері
Route::get('/test/{user}', [App\Http\Controllers\HomeController::class, 'testRole'])->name('testRole')->middleware('auth', 'can:admin-panel');
*/


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




/*
Role in Laravel
https://klisl.com/laravel-role-simple.html 
https://laravel.demiart.ru/laravel-gates/
https://step2.dev/ru/blog/7-laravel-gates-policies-guards-explained
*/
