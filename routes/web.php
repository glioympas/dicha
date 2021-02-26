<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;


Auth::routes();

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => ['auth', 'is_administrator']], function(){

	Route::get('/', [ HomeController::class , 'home' ] )->name('home');

	Route::resource('companies', CompanyController::class);
	Route::resource('employees', EmployeeController::class);

});