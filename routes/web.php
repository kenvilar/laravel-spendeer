<?php

Route::get('/', 'BudgetsController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Transactions
 */
Route::resource('transactions', 'TransactionsController', ['except' => ['show']]);

Route::get('/transactions/{category?}', 'TransactionsController@index');

/**
 * Categories
 */
Route::resource('categories', 'CategoriesController');

/**
 * Budgets
 */
Route::resource('budgets', 'BudgetsController');
