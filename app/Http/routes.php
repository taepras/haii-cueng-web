<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PagesController@main');
Route::get('/forecast', 'PagesController@viewForecast');
Route::get('/forecast/{station_id}', 'PagesController@viewForecastStation');
Route::get('/methodology', 'PagesController@methodology');
Route::get('/test_results', 'PagesController@results');
Route::get('/about', 'PagesController@About');
Route::get('/station', 'PagesController@viewStation');

Route::post('/forecast', 'PagesController@viewForecastPost');
Route::post('/test_results','PagesController@resultsPost');


Route::get('d/{page}', function ($page) {
   return view($page);
});
