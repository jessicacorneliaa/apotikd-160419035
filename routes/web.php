<?php

use App\Http\Controllers\MedicineController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Medicine
Route::resource('medicines', 'MedicineController');
Route::get('coba1', 'MedicineController@coba1');
Route::get('coba2', 'MedicineController@coba2');
Route::get('/report/listmedicine/{id}','MedicineController@showlist');

// Category
Route::resource('categories','CategoryController');

// Transaction
Route::resource('transactions','TransactionController');
Route::post('transactions/showDataAjax','TransactionController@showAjax')->name('transaction.showAjax');
Route::get('transactions/showDataAjax2/{id}','TransactionController@showAjax2')->name('transaction.showDataAjax2');

// Supplier
Route::resource('suppliers','SupplierController');
