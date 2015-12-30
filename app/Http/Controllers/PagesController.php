<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class PagesController extends Controller
{
    //
    public function main(){
        return view('main');
    }

    public function viewForecast(){;
        //    $info_station = null;
        //    $variable_station = null;
        //    return view('view_map')->with('info_station',$info_station)->with('variable_station',$variable_station);
        $station_id = "300201";
        $date = "1979-01-01";
        $a = \App\StationInfo::where('station_id','=',$station_id)->first();
        $info_station = json_decode($a,true);
        $b = \App\CFSV2::where('station_id','=',$station_id)->where('date','=',$date)->first();
        $variable_station = json_decode($b,true);
        return view('view_map')
        ->with('info_station',$info_station)
        ->with('variable_station',$variable_station)
        ->with('station_id',$station_id)
        ->with('date', $date);
    }

    public function viewForecastPost(){
        $station_id = Input::get('id');
        $date = Input::get('date');
        $a = \App\StationInfo::where('station_id','=',$station_id)->first();
        $info_station = json_decode($a,true);
        $b = \App\CFSV2::where('station_id','=',$station_id)->where('date','=',$date)->first();
        $variable_station = json_decode($b,true);
        return view('view_map')
        ->with('info_station',$info_station)
        ->with('variable_station',$variable_station)
        ->with('station_id',$station_id)
        ->with('date', $date);
    }

    public function viewForecastStation($station_id){
        // $start_date = Input::get('start_date');
        // $end_date = Input::get('end_date');

        // TEST sending json to view
        $start_date = "1979-01-01";
        $end_date = "1979-01-24";
        $a = \App\StationInfo::where('station_id','=',$station_id)->first();

        $info_station = json_decode($a,true);

        $b = \App\CFSV2::where('station_id','=',$station_id)->where('id','!=',0)->whereDate('date','>=',$start_date)->whereDate('date','<=',$end_date)->get();
        $variable_station = json_decode($b,true);

		$dataset = [];
		for($i = 0; $i < count($variable_station); $i++){
			foreach($variable_station[$i] as $var => $val){
				$dataset[$var][$i] = $val;
			}
		}

        return view('view_station')->with('b',$b)
            ->with('data',$dataset)
            ->with('info_station',$info_station)
            ->with('variable_station',$variable_station)
            ->with('station_id',$station_id)
            ->with('start_date',$start_date)
            ->with('end_date',$end_date);
    }

    public function viewResults(){
        $stations = \App\StationInfo::orderBy('province', 'ASC')->get();
        return view('view_test_map')->with('stations', $stations);
    }

    public function viewResultsStation($station_id){
        // $info_station = null;
        // $variable_station = null;
        // return view('view_test')->with('variable_station',$variable_station)->with('info_station',$info_station);
        $start_date = "1979-01-01";
        $end_date = "1979-01-24";
        $a = \App\StationInfo::where('station_id','=',$station_id)->first();
        $info_station = json_decode($a,true);
        $b = \App\CFSV2::where('station_id','=',$station_id)->whereDate('date','>=',$start_date)->whereDate('date','<=',$end_date)->get();
        $variable_station = json_decode($b,true);

        // calculate evaluators
        if(count($variable_station) > 0){
            $rmse = 0;
            for($i = 0; $i < count($variable_station); $i++){
                $rmse += pow($variable_station[$i]['actual_rainfall'] - $variable_station[$i]['predict_rainfall'], 2);
            }
            $rmse = sqrt($rmse / count($variable_station));

            $tp = 0; $fp = 0; $tn = 0; $fn = 0;
            for($i = 0; $i < count($variable_station); $i++){
                if($variable_station[$i]['actual_rainfall'] >= 0.1 && $variable_station[$i]['predict_rainfall'] >= 0.1){ $tp++; }
                if($variable_station[$i]['actual_rainfall'] <  0.1 && $variable_station[$i]['predict_rainfall'] >= 0.1){ $fp++; }
                if($variable_station[$i]['actual_rainfall'] <  0.1 && $variable_station[$i]['predict_rainfall'] <  0.1){ $tn++; }
                if($variable_station[$i]['actual_rainfall'] >= 0.1 && $variable_station[$i]['predict_rainfall'] <  0.1){ $fn++; }
            }
            if((2*$tp + $fp + $fn) !== 0) {
                $f1_score = 2*$tp / (2*$tp + $fp + $fn);
            } else {
                $f1_score = "NaN";
            }
        } else {
            $rmse = "NaN";
            $f1_score = "NaN";
        }

        $results = [];
        for ($i = 0; $i < count($variable_station); $i++) {
            $results[$i]['date'] = $variable_station[$i]['date'];
            $results[$i]['predict_rainfall'] = $variable_station[$i]['predict_rainfall'];
            $results[$i]['actual_rainfall'] = $variable_station[$i]['actual_rainfall'];
            $results[$i]['error'] = abs($results[$i]['predict_rainfall'] - $results[$i]['actual_rainfall']);
        }

        // echo var_dump($results);
        return view('view_test')
        ->with('results', $results)
        ->with('variable_station',$variable_station)
        ->with('info_station',$info_station)
        ->with('station_id',$station_id)
        ->with('start_date', $start_date)
        ->with('end_date', $end_date)
        ->with('rmse', $rmse)
        ->with('f1_score', $f1_score);
        //->with('json_data', $data);
    }

    public function viewResultsStationPost($station_id){
        $start_date = Input::get('start_date');
        $end_date = Input::get('end_date');
        $a = \App\StationInfo::where('station_id','=',$station_id)->first();
        $info_station = json_decode($a,true);
        $b = \App\CFSV2::where('station_id','=',$station_id)->whereDate('date','>=',$start_date)->whereDate('date','<=',$end_date)->get();
        $variable_station = json_decode($b,true);

        // calculate evaluators
        if(count($variable_station) > 0){
            $rmse = 0;
            for($i = 0; $i < count($variable_station); $i++){
                $rmse += pow($variable_station[$i]['actual_rainfall'] - $variable_station[$i]['predict_rainfall'], 2);
            }
            $rmse = sqrt($rmse / count($variable_station));

            $tp = 0; $fp = 0; $tn = 0; $fn = 0;
            for($i = 0; $i < count($variable_station); $i++){
                if($variable_station[$i]['actual_rainfall'] >= 0.1 && $variable_station[$i]['predict_rainfall'] >= 0.1){ $tp++; }
                if($variable_station[$i]['actual_rainfall'] <  0.1 && $variable_station[$i]['predict_rainfall'] >= 0.1){ $fp++; }
                if($variable_station[$i]['actual_rainfall'] <  0.1 && $variable_station[$i]['predict_rainfall'] <  0.1){ $tn++; }
                if($variable_station[$i]['actual_rainfall'] >= 0.1 && $variable_station[$i]['predict_rainfall'] <  0.1){ $fn++; }
            }
            if ((2*$tp + $fp + $fn) !== 0) {
                $f1_score = 2 * $tp / (2 * $tp + $fp + $fn);
            } else {
                $f1_score = "NaN";
            }
        } else {
            $rmse = "NaN";
            $f1_score = "NaN";
        }

        $results = [];
        for ($i = 0; $i < count($variable_station); $i++) {
            $results[$i]['date'] = $variable_station[$i]['date'];
            $results[$i]['predict_rainfall'] = $variable_station[$i]['predict_rainfall'];
            $results[$i]['actual_rainfall'] = $variable_station[$i]['actual_rainfall'];
            $results[$i]['error'] = abs($results[$i]['predict_rainfall'] - $results[$i]['actual_rainfall']);
        }

        return view('view_test')
                ->with('variable_station',$variable_station)
                ->with('info_station',$info_station)
                ->with('results', $results)
                ->with('station_id',$station_id)
                ->with('start_date', $start_date)
                ->with('end_date', $end_date)
                ->with('rmse', $rmse)
                ->with('f1_score', $f1_score);
    }

    public function methodology(){
        return view('methodology');
        // return view('main');
    }

    public function viewStation(){
        //    return view('methodology');
        return view('view_station');
    }

    public function about(){
        return view('about');
        // return view('main');
    }
}
