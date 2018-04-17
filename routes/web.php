<?php

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

/**
 * Transactions
 */
Route::resource('/transactions', 'TransactionsController', ['except' => ['show']]);

Route::get('/transactions/{category?}', 'TransactionsController@index');

/**
 * Categories
 */
Route::resource('/categories', 'CategoriesController', ['except' => ['show']]);

/**
 * Budget
 */
Route::get('/budgets', 'BudgetsController@index');

Route::post('/budgets', 'BudgetsController@store');

Route::patch('/budgets/{budget}', 'BudgetsController@update');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
