<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/portal/show/{id}', 'PortalController@show')->name('portal.show');
Route::get('/wiki/show/{id}', 'WikiController@show')->name('wiki.show');
Route::get('/all-portals', 'PortalController@showall')->name('portal.showall');
Route::get('/portal/search', 'PortalController@search')->name('portal.search');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/login', 'LoginController@index')->name('login.index');
    Route::get('/signup', 'SignupController@index')->name('signup.index');
 
    Route::post('/login', 'LoginController@store')->name('login.store');
    Route::post('/signup', 'SignupController@store')->name('signup.store');


});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', function(){
        Auth::logout();
        return redirect()->route('home.index');
    });
});

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::get('/', 'PortalController@index')->name('dashboard.index');
    Route::get('/wiki/create/{id}', 'WikiController@create')->name('wiki.create');
    Route::post('/wiki/store', 'WikiController@store')->name('wiki.store');
    Route::get('/wiki/edit/{id}', 'WikiController@edit')->name('wiki.edit');
    Route::post('/wiki/update/{id}', 'WikiController@update')->name('wiki.update');
    Route::get('/wiki/destroy/{id}', 'WikiController@destroy')->name('wiki.destroy');
    Route::get('/deck/show/{id}', 'DeckController@show')->name('deck.show');
    Route::get('/card/create/{id}', 'CardController@create')->name('card.create');
    Route::post('/card/store', 'CardController@store')->name('card.store');
    Route::get('/card/edit/{id}', 'CardController@edit')->name('card.edit');
    Route::post('/card/update/{id}', 'CardController@update')->name('card.update');
    Route::post('/card/destroy/{id}', 'CardController@destroy')->name('card.destroy');
    Route::get('/deck/create/{id}', 'DeckController@create')->name('deck.create');
    Route::post('/deck/store', 'DeckController@store')->name('deck.store');
    Route::get('/deck/edit/{id}', 'DeckController@edit')->name('deck.edit');
    Route::post('/deck/update/{id}', 'DeckController@update')->name('deck.update');
    Route::post('/deck/destroy/{id}', 'DeckController@destroy')->name('deck.destroy');
    Route::get('/portal/edit/{id}', 'PortalController@edit')->name('portal.edit');
    Route::get('/portal/create/', 'PortalController@create')->name('portal.create');
    Route::post('/portal/store', 'PortalController@store')->name('portal.store');
    Route::post('/portal/update/{id}', 'PortalController@update')->name('portal.update');
    Route::get('/portal/destroy/{id}', 'PortalController@destroy')->name('portal.destroy');
    Route::get('/document/create/{id}', 'DocumentController@create')->name('document.create');
    Route::post('/document/store', 'DocumentController@store')->name('document.store');
    Route::get('/document/show/{id}', 'DocumentController@show')->name('document.show');
    Route::get('/document/edit/{id}', 'DocumentController@edit')->name('document.edit');
    Route::post('/document/update/{id}', 'DocumentController@update')->name('document.update');
    Route::get('/document/destroy/{id}', 'DocumentController@destroy')->name('document.destroy');
    Route::get('/document/destroy/{id}', 'DocumentController@destroy')->name('document.destroy');
    Route::get('/tags/', 'TagController@index')->name('tag.index');
    Route::get('/tag/edit/{id}', 'TagController@edit')->name('tag.edit');
    Route::post('/tag/update/{id}', 'TagController@update')->name('tag.update');
    Route::post('/tag/destroy/{id}', 'TagController@destroy')->name('tag.destroy');
    Route::get('/tag/create', 'TagController@create')->name('tag.create');
    Route::post('/tag/store', 'TagController@store')->name('tag.store');
    Route::get('/portals/', 'PortalController@yours')->name('portal.yours');
    Route::get('/wikis/', 'WikiController@yours')->name('wiki.yours');
    Route::get('/decks/', 'DeckController@yours')->name('deck.yours');
    Route::get('/documents/', 'DocumentController@yours')->name('document.yours');
    Route::get('/settings/', 'SettingsController@index')->name('setting.index');
    Route::post('/settings/update', 'SettingsController@update')->name('setting.update');
    Route::post('/bank/store', 'BankController@store')->name('bank.store');
    Route::get('/bank', 'BankController@index')->name('bank.index');
    Route::get('/bank/delete/{id}', 'BankController@destroy')->name('bank.destroy');
    Route::get('/review/{id}', 'ReviewController@show')->name('review.show');
    Route::post('/card/import/{id}', 'CardController@import')->name('card.import');
});

Route::group(['middleware' => 'api'], function () {
    Route::post('/api/card/{id}', 'APIController@index')->name('api.index');
    Route::post('/api/rate', 'APIController@store')->name('api.store');
    Route::post('/api/set/active', 'APIController@setActive')->name('api.setActive');
});
