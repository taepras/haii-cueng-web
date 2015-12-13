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
       //$info_station = "AAA";
       $a = \App\StationInfo::where('station_id','=','300201')->first();
       $info_station = json_decode($a,true);
       return view('view_map',compact('info_station'));
   }

   public function viewForecastStation($station_id){
       $a = \App\StationInfo::where('station_id','=',$station_id)->first();
       $info_station = json_decode($a,true);
       return view('view_map',compact('info_station'));
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
