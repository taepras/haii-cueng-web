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
Route::get('/test_results', 'PagesController@viewResults');
Route::get('/test_results/{station_id}', 'PagesController@viewResultsStation');
Route::get('/about', 'PagesController@About');
Route::get('/station', 'PagesController@viewStation');

Route::post('/forecast', 'PagesController@viewForecast');
Route::post('/forecast/{station_id}', 'PagesController@viewForecastStation');
Route::post('/test_results/{station_id}','PagesController@viewResultsStation');


Route::get('d/{page}', function ($page) {
   return view($page);
});
