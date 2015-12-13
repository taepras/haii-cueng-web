<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
   //
   public function main(){
      return view('main');
   }

   public function viewForecast(){
       return view('view_map');
   }

   public function viewForecastStation($station_id){
       return view('view_station');
   }

   public function results($station_id){
       return view('results');
   }

   public function methodology(){
       return view('methodology');
   }

   public function about(){
       return view('about');
   }
}
