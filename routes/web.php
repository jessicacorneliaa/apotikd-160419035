<?php

use App\Http\Controllers\MedicineController;
use App\Supplier;
use Illuminate\Support\Facades\Auth;
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




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group( function(){
    Route::get('/', function () {
        return view('layout.conquer');
    });
    // Medicine
    Route::resource('medicines', 'MedicineController');
    Route::get('coba1', 'MedicineController@coba1');
    Route::get('coba2', 'MedicineController@coba2');
    Route::get('/report/listmedicine/{id}','MedicineController@showlist');
    Route::post('medicines/getEditForm', 'MedicineController@getEditForm')->name('medicines.getEditForm');
    Route::post('medicines/getEditForm2', 'MedicineController@getEditForm2')->name('medicines.getEditForm2');
    Route::post('medicines/saveData', 'Medicineontroller@saveData')->name('medicines.saveData');
    Route::post('medicines/deleteData', 'MedicineController@deleteData')->name('medicines.deleteData');

    // Category
    Route::resource('categories','CategoryController');

    // Transaction
    Route::resource('transactions','TransactionController');
    Route::post('transactions/showDataAjax','TransactionController@showAjax')->name('transaction.showAjax');
    Route::get('transactions/showDataAjax2/{id}','TransactionController@showAjax2')->name('transaction.showDataAjax2');

    // Supplier
    Route::resource('suppliers','SupplierController');
    Route::post('suppliers/getEditForm', 'SupplierController@getEditForm')->name('suppliers.getEditForm');
    Route::post('suppliers/getEditForm2', 'SupplierController@getEditForm2')->name('suppliers.getEditForm2');
    Route::post('suppliers/saveData', 'SupplierController@saveData')->name('suppliers.saveData');
    Route::post('suppliers/deleteData', 'SupplierController@deleteData')->name('suppliers.deleteData');
});
