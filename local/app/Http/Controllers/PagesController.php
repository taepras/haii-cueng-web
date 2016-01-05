<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class PagesController extends Controller
{
	const DEFAULT_STATION = "455601";

	public function main(){
		$user = Auth::user();
		return view('main')->with('user', $user);
	}

	public function login(){
		$user = Auth::user();
		if($user != null)
			return redirect('/');
		$hasError = Session::get('hasError');
		return view('login', compact('hasError'));
	}

	public function postLogin(){
		$uid = Input::get('student-id');
		$pw = Input::get('pwd');
		$remember = Input::get('remember');
		if(Auth::attempt(['username' => $uid, 'password' => $pw], $remember))
			return redirect('/forecast');
		else
			return Redirect::back()->with('hasError', true);
	}

	public function logout()
	{
		$user = Auth::user();
		if($user==null)
			return Redirect::back();
		Auth::logout();
		Session::flush();
		return redirect('/');
	}

	public function viewForecast(){
		$user = Auth::user();
		$station_id = Input::get('id');
		if(!$station_id)
			$station_id = self::DEFAULT_STATION;

		$a = \App\StationInfo::where('station_id','=',$station_id)->first();
		$info_station = json_decode($a, true);
		$info_station['start_date'] = \App\CFSv2::where('station_id', '=', $station_id)->min('date');
		$info_station['end_date']   = \App\CFSv2::where('station_id', '=', $station_id)->max('date');

		$min_date = \App\CFSv2::min('date');
		$max_date   = \App\CFSv2::max('date');

		$date = Input::get('date');
		if(!$date){
			$today = date('Y-m-d');
			if($min_date <= $today && $today <= $max_date)
				$date = $today;
			elseif($max_date <= $today)
				$date = $max_date;
			else
				$date = $min_date;
		}
		$b = \App\CFSV2::where('station_id', '=', $station_id)->where('date', '=', $date)->first();
		$variable_station = json_decode($b,true);
		if(!$user && $variable_station){
			foreach ($variable_station as $row) {
				if(isset($row['actual_rainfall'])){
					unset($row['actual_rainfall']);
				}
			}
		}
		$no_data = !$variable_station;

		$map_data = \App\CFSV2::where('date','=',$date)
			->join('station_infos','cfsv2s.station_id','=','station_infos.station_id')
			->select('station_infos.station_id','station_infos.station_name',
				'station_infos.latitude','station_infos.longitude',
				'cfsv2s.predict_rainfall')
			->get();
		// return an object that looks like this to view for map plotting:
		// date 		| station_id | station_name	| lat  | long | predict_rainfall |
		// -------------+------------+--------------+------+------+------------------|
		// yyyy-mm-dd	| xxxxxx	 | xxxxxxxxx	| x.xx | x.xx | x.xx			 |
		// (same date)	| xxxxxx	 | xxxxxxxxx	| x.xx | x.xx | x.xx			 |

		return view('view_map')
			->with('info_station',$info_station)
			->with('variable_station',$variable_station)
			->with('station_id',$station_id)
			->with('date', $date)
			->with('map_data',$map_data)
			->with('min_date',$min_date)
			->with('max_date',$max_date)
			->with('user', $user)
			->with('no_data', $no_data);
	}

	public function viewForecastStation($station_id){
		$user = Auth::user();
		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');

		$a = \App\StationInfo::where('station_id','=',$station_id)->first();
		$info_station = json_decode($a, true);
		$info_station['start_date'] = \App\CFSv2::where('station_id', '=', $station_id)->min('date');
		$info_station['end_date']   = \App\CFSv2::where('station_id', '=', $station_id)->max('date');

		if(!$start_date)
			$start_date = $info_station['start_date'];
		if(!$end_date)
			$end_date = $info_station['end_date'];

		$b = \App\CFSV2::where('station_id','=',$station_id)->where('id','!=',0)->whereDate('date','>=',$start_date)->whereDate('date','<=',$end_date)->get();
		$variable_station = json_decode($b,true);

		$dataset = [];
		$hasActual = false;
		for($i = 0; $i < count($variable_station); $i++){
			foreach($variable_station[$i] as $var => $val){
				$dataset[$var][$i] = $val;
			}
			if($dataset['actual_rainfall'])
				$hasActual = true;
		}
		if(!$user){
			unset($dataset['actual_rainfall']);
		}

		return view('view_station')->with('b',$b)
			->with('data',$dataset)
			->with('info_station',$info_station)
			->with('station_id',$station_id)
			->with('start_date',$start_date)
			->with('end_date',$end_date)
			->with('user', $user)
			->with('hasActual', $hasActual);
	}

	public function viewResults(){
		$user = Auth::user();
		$info_station = \App\StationInfo::orderBy('province', 'ASC')->get();
		return view('view_test_map')
		->with('info_station', $info_station)
		->with('user', $user);
	}

	public function viewResultsStation($station_id){
		$user = Auth::user();
		// $info_station = null;
		// $variable_station = null;
		// return view('view_test')->with('variable_station',$variable_station)->with('info_station',$info_station);
		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');

		$a = \App\StationInfo::where('station_id','=',$station_id)->first();
		$info_station = json_decode($a,true);
		$info_station['start_date'] = \App\CFSv2::where('station_id', '=', $station_id)->min('date');
		$info_station['end_date']   = \App\CFSv2::where('station_id', '=', $station_id)->max('date');

		if(!$start_date)
			$start_date = $info_station['start_date'];
		if(!$end_date)
			$end_date = $info_station['end_date'];

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
			if($user){
				$results[$i]['actual_rainfall'] = $variable_station[$i]['actual_rainfall'];
			}
			$results[$i]['error'] = abs($results[$i]['predict_rainfall'] - $variable_station[$i]['actual_rainfall']);
		}

		// echo var_dump($results);
		return view('view_test')
		->with('results', $results)
		->with('info_station',$info_station)
		->with('station_id',$station_id)
		->with('start_date', $start_date)
		->with('end_date', $end_date)
		->with('rmse', $rmse)
		->with('f1_score', $f1_score)
		->with('user', $user);
		//->with('json_data', $data);
	}

	public function methodology(){
		$user = Auth::user();
		return view('methodology')->with('user', $user);
	}

	public function viewStation(){
		$user = Auth::user();
		return view('view_station')->with('user', $user);
	}

	public function about(){
		$user = Auth::user();
		return view('about')->with('user', $user);
	}

	public function changePassword(){
		$user = Auth::user();
        if($user==null)
            return redirect('/login');
        $old_password = Input::get('old-password');
        $new_password = Input::get('new-password');
        $confirm_new_password = Input::get('confirm-new-password');
        if(!$old_password && !$new_password && !$confirm_new_password) {
		    return view('change_password')->with('user', $user);
		} elseif(!$old_password || !$new_password || !$confirm_new_password){
            return view('change_password')->with('error', 'blank field')->with('user', $user);
        } elseif(!Hash::check($old_password,$user['password'])){
            return view('change_password')->with('error', 'wrong password')->with('user', $user);
        } elseif($new_password != $confirm_new_password){
            return view('change_password')->with('error', 'password mismatch')->with('user', $user);
		} else{
			$user->fill([
	            'password' => Hash::make($new_password)
	        ])->save();
	        return redirect('/change_password_success');
		}
	}

	public function changePasswordSuccess(){
		$user = Auth::user();
		if($user==null)
			return redirect('/login');
		return view('change_password_success')->with('user', $user);
	}

	public function toDownloads(){
		return redirect('/downloads');
	}

	public function viewDownloads(){
		$user = Auth::user();
		if(!$user)
			return redirect('/login');
		return view('downloads')->with('user', $user);
	}

	public function downloadCfs($station_id){
		$user = Auth::user();
		if(!$user)
			return redirect('/login');

		$cfsv2ColumnNames = [
			"id","station_id","date",

			"gph200_0","gph850_0","h200_0","h850_0","p_msl_0","p_sfl_0",
			"temp200_0","temp850_0","u200_0","u850_0","v200_0","v850_0",

			"gph200_6","gph850_6","h200_6","h850_6","p_msl_6","p_sfl_6",
			"temp200_6","temp850_6","u200_6","u850_6","v200_6","v850_6",

			"gph200_12","gph850_12","h200_12","h850_12","p_msl_12","p_sfl_12",
			"temp200_12","temp850_12","u200_12","u850_12","v200_12","v850_12",

			"gph200_18","gph850_18","h200_18","h850_18","p_msl_18","p_sfl_18",
			"temp200_18","temp850_18","u200_18","u850_18","v200_18","v850_18",

			"actual_rainfall","predict_rainfall"
		];

		$table = \App\CFSv2::where('station_id', '=', $station_id)->get();
		echo implode(",", $cfsv2ColumnNames);
		foreach ($table as $row) {
			echo "\n";
			echo implode(",", $row->toArray());
		}
	}

	public function downloadStations(){
		$user = Auth::user();
		if(!$user)
			return redirect('/login');

		$StationInfoColumnNames = [
			"id","station_id","station_name",
			"sub_district","district","province",
			"latitude","longitude","f1_score","rmse"
		];

		$table = \App\StationInfo::all();
		echo implode(",", $StationInfoColumnNames);
		foreach ($table as $row) {
			echo "\n";
			echo implode(",", $row->toArray());
		}
	}

	public function viewUpload(){
		$user = Auth::user();
		if(!$user)
			return redirect('/login');
		return view('upload')->with('user', $user);
	}

	public function postUpload(){
		$user = Auth::user();
		if(!$user)
			return redirect('/login');

		if (Input::hasFile('file')){
			$cfsv2ColumnNames = [
				"station_id","date",

				"gph200_0","gph850_0","h200_0","h850_0","p_msl_0","p_sfl_0",
				"temp200_0","temp850_0","u200_0","u850_0","v200_0","v850_0",

				"gph200_6","gph850_6","h200_6","h850_6","p_msl_6","p_sfl_6",
				"temp200_6","temp850_6","u200_6","u850_6","v200_6","v850_6",

				"gph200_12","gph850_12","h200_12","h850_12","p_msl_12","p_sfl_12",
				"temp200_12","temp850_12","u200_12","u850_12","v200_12","v850_12",

				"gph200_18","gph850_18","h200_18","h850_18","p_msl_18","p_sfl_18",
				"temp200_18","temp850_18","u200_18","u850_18","v200_18","v850_18",

				"actual_rainfall","predict_rainfall"
			];
			$file = Input::file('file');
			$name = time() . '-' . $file->getClientOriginalName();
			$new_path = public_path() . '/uploads/';
			$file->move($new_path, $name);

			$cfs_col_string = implode(",", $cfsv2ColumnNames);

			$csv = fopen($new_path . $name, 'r');
			$csv_col_names = fgetcsv($csv);
			$id_index = array_search("id", $csv_col_names);
			if ($id_index !== false)
				unset($csv_col_names[$id_index]);

			$pdo = \DB::connection()->getPdo();

			$rows_left = true;
			while(!feof($csv)){
				$var = fgetcsv($csv);
				if ($var){
					if ($id_index !== false)
						unset($var[$id_index]);
					$new_var = [];
					foreach ($var as $key => $value) {
						$new_var[$key] = $pdo->quote($value);
					}

					$q = 'insert into cfsv2s (' .
						implode(",", $csv_col_names) .
						') values (' .
						implode(",", $new_var) .
						')';
					$pdo->query($q);
				}
			}

			return view('upload')->with('user', $user)->with('success', true);
	     }

		 return view('upload')->with('user', $user)->with('error', 'กรุณาเลือกไฟล์');
	}
}
