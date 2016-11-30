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


Auth::routes();
Route::get('login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@showLoginForm', 'middleware' => 'guest']);
Route::get('register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@showRegistrationForm', 'middleware' => 'guest']);

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/search', function(){
        return redirect()->route('home.index');
    });
    Route::get('/wiki/show/{id}', 'WikiController@show')->name('wiki.show');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('/wikis/', 'WikiController@index')->name('wiki.index');

    Route::get('/deck/show/{id}', 'DeckController@show')->name('deck.show');

    Route::post('/bank/add', 'BankController@store')->name('bank.store');

    Route::get('/review/{id}', 'CardController@show')->name('card.show');

    Route::get('/account/{id}', 'AccountController@show')->name('account.show');

    Route::POST('/user/update', 'UserController@update')->name('user.update');

    Route::get('/wiki/create', 'WikiController@create')->name('wiki.create');

    Route::post('/wiki/store', 'WikiController@store')->name('wiki.store');

    Route::post('/tag/store', 'TagController@store')->name('tag.store');

    Route::post('/deck/store', 'DeckController@store')->name('deck.store');

    Route::get('/card/create', 'CardController@create')->name('card.create');

    Route::post('/card/store', 'CardController@store')->name('card.store');

    Route::get('/card/view/{id}', 'CardController@view')->name('card.view');
    
    Route::get('/wiki/edit/{id}', 'WikiController@edit')->name('wiki.edit');
    
    Route::post('/wiki/update/{id}', 'WikiController@update')->name('wiki.update');
    
    Route::post('/wiki/destroy/{id}', 'WikiController@destroy')->name('wiki.destroy');
    
    Route::get('/deck/edit/{id}', 'DeckController@edit')->name('deck.edit');
    
    Route::post('/deck/update/{id}', 'DeckController@update')->name('deck.update');
    
    Route::post('/deck/destroy/{id}', 'DeckController@destroy')->name('deck.destroy');
    
    Route::get('/card/edit/{id}', 'CardController@edit')->name('card.edit');
    
    Route::post('/card/update/{id}', 'CardController@update')->name('card.update');
    
    Route::post('/card/destroy/{id}', 'CardController@destroy')->name('card.destroy');
    
    Route::get('/tag/edit/{id}', 'TagController@edit')->name('tag.edit');
    
    Route::post('/tag/update/{id}', 'TagController@update')->name('tag.update');
    
    Route::post('/tag/destroy/{id}', 'TagController@destroy')->name('tag.destroy');

    Route::post('/bank/destroy/{id}', 'BankController@destroy')->name('bank.destroy');

    Route::post('/search', 'SearchController@index')->name('search.index');
});

Route::group(['middleware' => 'api'], function () {
    Route::post('/api/card/{id}', 'APIController@index')->name('api.index');

    Route::post('/api/rate', 'APIController@store')->name('api.store');

    Route::post('/api/set/active', 'APIController@setActive')->name('api.setActive');

});



// Route::get('/', 'HomeController@index')->name('home_index');

// Route::get('/logout', 'PagesController@logout')->name('logout');
// Route::get('/signup', 'SignUpController@index')->name('signup_index');

// Route::get('/wikis', 'WikiController@index')->name('deckIndex');
// Route::get('/wiki/{id}', 'WikiController@show')->name('wikiShow');

// Route::get('/decks', 'DeckController@index')->name('wikiIndex');
// Route::get('/deck/{id}', 'DeckController@show')->name('deckShow');
// Route::get('/deck/review/{id}', 'DeckController@review')->name('deckReview');

// Route::get('/account', 'AccountController@index')->name('accountIndex');

// Route::get('/account/bank', 'BankController@index')->name('bankIndex');
// Route::post('/account/bank/add', 'BankController@add')->name('bankAdd');

// Route::post('/api/card/{id}', 'APIController@card')->name('APICard');
// Route::post('/api/rate', 'APIController@rate')->name('APIRate');
