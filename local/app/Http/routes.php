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
Route::get('/login','PagesController@login');
Route::get('/logout','PagesController@logout');
Route::get('/forecast', 'PagesController@viewForecast');
Route::get('/forecast/{station_id}', 'PagesController@viewForecastStation');
Route::get('/methodology', 'PagesController@methodology');
Route::get('/test_results', 'PagesController@viewResults');
Route::get('/test_results/{station_id}', 'PagesController@viewResultsStation');
Route::get('/about', 'PagesController@About');
Route::get('/station', 'PagesController@viewStation');
Route::get('/login', 'PagesController@login');
Route::get('/change_password', 'PagesController@changePassword');
Route::get('/change_password_success', 'PagesController@changePasswordSuccess');

Route::get('/downloads', 'PagesController@viewDownloads');
Route::get('/downloads/stations.csv', 'PagesController@downloadStations');
Route::get('/downloads/cfsv2/{station_id}.csv', 'PagesController@downloadCfs');
Route::get('/downloads/{other}', 'PagesController@toDownloads');
Route::get('/upload', 'PagesController@viewUpload');

Route::post('/forecast', 'PagesController@viewForecast');
Route::post('/forecast/{station_id}', 'PagesController@viewForecastStation');
Route::post('/test_results/{station_id}','PagesController@viewResultsStation');
Route::post('/login','PagesController@postLogin');
Route::post('/change_password', 'PagesController@changePassword');
Route::post('/upload', 'PagesController@postUpload');


Route::get('d/{page}', function ($page) {
   return view($page);
});
