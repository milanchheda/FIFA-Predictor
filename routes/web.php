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
// Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/predictions', ['middleware' => 'auth', 'uses' => 'PredictionsController@index']);
Route::post('/predictions', ['middleware' => 'auth', 'uses' => 'PredictionsController@saveUserPrediction']);

Route::get('/fixtures', ['middleware' => 'auth', 'uses' => 'FixturesController@index']);
Route::post('/fixtures', ['middleware' => 'auth', 'uses' => 'FixturesController@saveUserSelections']);

Route::get('leader-board', ['middleware' => 'auth', 'uses' => 'AdminController@showLeaderBoard']);

Route::group(['prefix' => 'admin', 'middleware' => 'can:isAdmin'], function() {
    Route::get('/', 'AdminController@index');
    // Route::get('/set-lock-times', 'AdminController@setLockTimes');
    Route::post('/set-lock-times', 'AdminController@saveLockTimes');

    Route::post('/predictions', 'AdminController@savePredictions');
    Route::post('/save-prediction-lock-times', 'AdminController@savePredictionLockTime');
});
