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
       $b = \App\CFSV2::all()->last();
       $variable_station = json_decode($b,true);
       return view('view_map')->with('info_station',$info_station)->with('variable_station',$variable_station);
   }

   public function viewForecastStation($station_id){
       $a = \App\StationInfo::where('station_id','=',$station_id)->first();
       $info_station = json_decode($a,true);
       return view('view_map',compact('info_station'));
   }

   public function results(){
       return view('view_test');
   }

   public function methodology(){
    //    return view('methodology');
       return view('main');
   }

   public function about(){
    //    return view('about');
       return view('main');
   }
}
