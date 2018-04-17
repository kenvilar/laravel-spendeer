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

Route::get('/', 'BudgetsController@index');

/**
 * Transactions
 */
Route::resource('/transactions', 'TransactionsController', ['except' => ['show']]);

Route::get('/transactions/{category?}', 'TransactionsController@index');

/**
 * Categories
 */
Route::resource('/categories', 'CategoriesController');

/**
 * Budgets
 */
Route::get('/budgets', 'BudgetsController@index');

Route::get('/budgets/create', 'BudgetsController@create');

Route::post('/budgets', 'BudgetsController@store');

Route::get('/budgets/{budget}', 'BudgetsController@edit');

Route::patch('/budgets/{budget}', 'BudgetsController@update');

Route::delete('/budgets/{budget}', 'BudgetsController@destroy');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
