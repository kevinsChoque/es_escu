<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CatastroController;
use App\Http\Controllers\Cf2Controller;
use App\Http\Controllers\FcController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;

// Route::get('/', function () {return view('form.form');});
Route::get('/',[CatastroController::class, 'actForm']);
Route::post('catastro/save',[CatastroController::class, 'actSave']);
Route::post('catastro/saveChanges',[CatastroController::class, 'actSaveChanges']);
Route::get('catastro/buscar',[CatastroController::class, 'actBuscar']);

Route::get('ct2/form2',[Cf2Controller::class, 'actForm2']);
Route::get('ct2/showInfo',[Cf2Controller::class, 'actShowInfo']);
Route::post('ct2/save',[Cf2Controller::class, 'actSave']);
Route::post('ct2/saveChanges',[Cf2Controller::class, 'actSaveChanges']);
Route::get('ct2/list',[Cf2Controller::class, 'actList']);

Route::get('login',[LoginController::class, 'actLogin']);
Route::post('login/sigin',[LoginController::class, 'actSigin']);
Route::get('login/home',[LoginController::class, 'actHome']);

Route::get('catastro/list',[CatastroController::class, 'actList']);
Route::post('catastro/deleteReg',[CatastroController::class, 'actDeleteReg']);
Route::post('catastro/showFile',[FcController::class, 'actShowFile']);

Route::get('report/show',[ReportController::class, 'actShow']);


