<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ClienteController;

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

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/home',[HomeController::class, 'index'])->middleware('auth');
Route::get('/alterar-senha',[HomeController::class, 'editSenha'])->middleware('auth')->name('auth.edit');

//Clientes
Route::get('/clientes',[ClienteController::class,'index'])->middleware('auth')->name('clientes.index');
Route::get('/clientes/deletar/{cliente}',[ClienteController::class,'destroy'])->middleware('auth')->name('clientes.destroy');
Route::post('/clientes/salvar',[ClienteController::class,'store'])->middleware('auth')->name('clientes.store');
Route::post('/clientes/atualizar/{cliente}',[ClienteController::class,'update'])->middleware('auth')->name('clientes.update');

