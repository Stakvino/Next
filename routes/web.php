<?php

use App\Fournisseur;

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


//Fournisseur routes
Route::group(['prefix' => '/crm/fournisseurs'], function () {
  
  Route::get('/', 'FournisseurController@index')
  ->name('fournisseur.index');

  Route::post('/store', 'FournisseurController@store')
  ->name('fournisseur.store');

  Route::delete('/{id}/destroy', 'FournisseurController@destroy')
  ->name('fournisseur.destroy');

  Route::patch('{id}/update', 'FournisseurController@update')
  ->name('fournisseur.update');

  Route::get('{id}/show', 'FournisseurController@show')
  ->name('fournisseur.show');

  Route::get('/filtered', 'FournisseurController@filtered')
  ->name('fournisseur.filtered');

  //Fournisseur contacts routes

  Route::get('{fournisseur}/contacts', 'ContactController@index')
    ->name('contact.index');

  Route::group(['prefix' => '/contacts'], function () {
            
    Route::get('/{contact}/show', 'ContactController@show')
    ->name('contact.show');

    Route::post('/store', 'ContactController@store')
    ->name('contact.store');

    Route::patch('/{id}/update', 'ContactController@update')
    ->name('contact.update');

    Route::delete('/{id}/destroy', 'ContactController@destroy')
    ->name('contact.destroy');

  });

});

