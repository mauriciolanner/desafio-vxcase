<?php

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
Route::get('/', 'HomeController@store')->name('home');

//rotas de produtos
Route::get('/produtos', 'ProductController@index')->name('produtos');   
Route::get('/produtos/novo', 'ProductController@new')->name('novoprodutos');
Route::post('/produto/criar', 'ProductController@store')->name('criaproduto');
Route::post('/produto/editar', 'ProductController@edit')->name('editarproduto');
Route::get('/produto/detalhes/{id}', 'ProductController@details')->name('detalhesproduto');
Route::post('/produto/deleta', 'ProductController@delet')->name('deletaproduto');

//rotas de compras
Route::get('/dashboard', 'DashboardController@index')->name('home');
Route::get('/pedido/detalhes/{id}', 'DashboardController@cartDetail');

//rotas de API para Json
Route::get('/carrinho-api', 'CartController@apiCart');
Route::post('/add-carrinho', 'CartController@apiAddCart');
Route::post('/deleta-carrinho', 'CartController@deletCart');
Route::get('/finaliza-carrinho', 'CartController@finishCart');

Auth::routes();
