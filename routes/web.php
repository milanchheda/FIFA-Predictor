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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/predictions', 'PredictionsController@index');
Route::post('/predictions', 'PredictionsController@saveUserPrediction');

Route::get('/fixtures', 'FixturesController@index');
Route::post('/fixtures', 'FixturesController@saveUserSelections');

Route::get('leader-board', 'AdminController@showLeaderBoard');

Route::group(['prefix' => 'admin', 'middleware' => 'can:isAdmin'], function() {
    Route::get('/', 'AdminController@index');
    Route::get('/set-lock-times', 'AdminController@setLockTimes');
    Route::post('/set-lock-times', 'AdminController@saveLockTimes');

    Route::post('/predictions', 'AdminController@savePredictions');
    Route::post('/save-prediction-lock-times', 'AdminController@savePredictionLockTime');
});
