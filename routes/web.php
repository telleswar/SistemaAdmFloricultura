<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\MovEstoqueController;
use App\Http\Controllers\MovFinanceiraController;

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
// Route::get('/alterar-senha',[HomeController::class, 'auth_edit'])->middleware('auth')->name('auth.edit');
// Route::post('/alterar-senha/salvar',[HomeController::class, 'auth_update'])->middleware('auth')->name('auth.store');

//Clientes
Route::get('/clientes',[ClienteController::class,'index'])->middleware('auth')->name('clientes.index');
Route::get('/clientes/deletar/{cliente}',[ClienteController::class,'destroy'])->middleware('auth')->name('clientes.destroy');
Route::post('/clientes/salvar',[ClienteController::class,'store'])->middleware('auth')->name('clientes.store');
Route::post('/clientes/atualizar/{cliente}',[ClienteController::class,'update'])->middleware('auth')->name('clientes.update');

//Estoque
Route::get('/estoque',[MovEstoqueController::class,'index'])->middleware('auth')->name('movs_estoque.index');
Route::get('/estoque/deletar/{mov_Estoque}',[MovEstoqueController::class,'destroy'])->middleware('auth')->name('movs_estoque.destroy');
Route::post('/estoque/salvar',[MovEstoqueController::class,'store'])->middleware('auth')->name('movs_estoque.store');

//Fornecedores
Route::get('/fornecedores',[FornecedorController::class,'index'])->middleware('auth')->name('fornecedores.index');
Route::get('/fornecedores/deletar/{fornecedor}',[FornecedorController::class,'destroy'])->middleware('auth')->name('fornecedores.destroy');
Route::post('/fornecedores/salvar',[FornecedorController::class,'store'])->middleware('auth')->name('fornecedores.store');
Route::post('/fornecedores/atualizar/{fornecedor}',[FornecedorController::class,'update'])->middleware('auth')->name('fornecedores.update');

//Produtos
Route::get('/produtos',[ProdutoController::class,'index'])->middleware('auth')->name('produtos.index');
Route::get('/produtos/deletar/{produto}',[ProdutoController::class,'destroy'])->middleware('auth')->name('produtos.destroy');
Route::post('/produtos/salvar',[ProdutoController::class,'store'])->middleware('auth')->name('produtos.store');
Route::post('/produtos/atualizar/{produto}',[ProdutoController::class,'update'])->middleware('auth')->name('produtos.update');

//Financeiro
Route::get('/financeiro',[MovFinanceiraController::class,'index'])->middleware('auth')->name('movs_financeira.index');
Route::get('/financeiro/deletar/{mov_Financeira}',[MovFinanceiraController::class,'destroy'])->middleware('auth')->name('movs_financeira.destroy');
Route::post('/financeiro/receita/salvar',[MovFinanceiraController::class,'store_receita'])->middleware('auth')->name('movs_financeira.store_receita');
Route::post('/financeiro/despesa/salvar',[MovFinanceiraController::class,'store_despesa'])->middleware('auth')->name('movs_financeira.store_despesa');

//Pedidos
Route::get('/pedidos/deletar/{pedido}',[PedidoController::class,'destroy'])->middleware('auth')->name('pedidos.destroy');
Route::post('/pedidos/salvar',[PedidoController::class,'store'])->middleware('auth')->name('pedidos.store');
Route::post('/pedidos/atualizar/{pedido}',[PedidoController::class,'update'])->middleware('auth')->name('pedidos.update');
Route::post('/pedidos/adicionar/{pedido}',[PedidoController::class,'add'])->middleware('auth')->name('pedidos.add');




