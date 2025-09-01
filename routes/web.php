<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CatastroController;
use App\Http\Controllers\LoginController;

// Route::get('/', function () {return view('form.form');});
Route::get('/',[CatastroController::class, 'actForm']);
Route::post('catastro/save',[CatastroController::class, 'actSave']);
Route::get('catastro/buscar',[CatastroController::class, 'actBuscar']);

Route::get('login',[LoginController::class, 'actLogin']);
Route::post('login/sigin',[LoginController::class, 'actSigin']);
Route::get('login/home',[LoginController::class, 'actHome']);

Route::get('catastro/list',[CatastroController::class, 'actList']);

