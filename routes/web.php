<?php

use Illuminate\Support\Facades\Route;


// Auth::routes();

Route::middleware(['auth'])->group(function() {
    Route::get('/admin', 'AdminController@index')->name('admin');
    Route::get('/admin/inscritos/{sessao}', 'AdminController@inscritos')->name('sessao');
    Route::post('/admin/inscritos/update/{sessao}/{inscrito}', 'AdminController@updateInscritos')->name('update.incritos');
});

Route::get('/', 'HomeController@index')->name('home');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/{event}/{day}', 'FormController@index')->name('form');
Route::post('/{event}/{day}', 'FormController@store')->name('form.store');

