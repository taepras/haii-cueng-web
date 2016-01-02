@extends('template.master')


@section('page-header')
<h1>ผลการพยากรณ์</h1>
<p>ผลการพยากรณ์ปริมาณฝน ณ วันที่ {{date("d/m/Y", strtotime($date))}} </a></p>
@stop


@section('content')
<form role="form" class="form-inline" method="post" action="{{url().'/forecast'}}">
	<div class="col-sm-12">
		<div class="row">
			<div class="col-sm-12">
				<div class="form-inline">
					{!! csrf_field() !!}
					<label class="light-label">เลือกดูข้อมูล ณ วันที่&nbsp;&nbsp;</label>
					<input type="date" class="form-control" name="date" id="date">
					&nbsp;&nbsp;
					<button type="submit" class="btn btn-primary">ดูข้อมูล &raquo;</button>
				</div>
			</div>
		</div>
		<hr>
	</div>
	<div class="col-sm-5">
		<h4><b>ผลการพยากรณ์ปริมาณฝนทั่วประเทศ<br>ณ วันที่ {{date("d/m/Y", strtotime($date))}}</b></h4>
		<div id="chart"></div>
	</div>
	<div class="col-sm-7">

		<div class="row">
			<div class="col-sm-12 form-inline">
				{{-- <div class=""> --}}
				<label class="light-label">เลือกดูข้อมูล ณ สถานี&nbsp;&nbsp;</label>
				@include('partials.station_selector', ['style' => 'max-width: 220px'])
				&nbsp;&nbsp;
				<button type="submit" class="btn btn-default">เลือกสถานี</button>
				{{-- </div> --}}
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-sm-6">

				<p>สถานีตรวจวัดปริมาณฝน</p>
				<h3 class="station-name"><b>{{$info_station['station_name']}}</b></h3>
				<div>
					<table class="table text-left">
						<tr>
							<th>ตำบล</th>
							<td>{{$info_station['sub_district']}}</td>
						</tr>
						<tr>
							<th>อำเภอ</th>
							<td>{{$info_station['district']}}</td>
						</tr>
						<tr>
							<th>จังหวัด</th>
							<td>{{$info_station['province']}}</td>
						</tr>
						<tr>
							<th>มีข้อมูลตั้งแต่วันที่</th>
							<td>{{date("d/m/Y", strtotime($info_station['start_date']))}}</td>
						</tr>
						<tr>
							<th>มีข้อมูลถึงวันที่</th>
							<td>{{date("d/m/Y", strtotime($info_station['end_date']))}}</td>
						</tr>

					</table>
				</div>
			</div>
			<div class="col-sm-6">
				<p>
					ผลการพยากรณ์<br>
					ปริมาณฝน ณ วันที่ {{date("d/m/Y", strtotime($date))}}
				</p>
				<h1 class="huge-text" id="rainfall">{{ round($variable_station['predict_rainfall'], 1) }}</h1>
				<p>
					มิลลิเมตร{{--<sup><a href="">[?]</a></sup>--}}
					<span id="droplets"></span>
				</p>
				@if(isset($variable_station['actual_rainfall']))
				<p>
					<b>ปริมาณฝนจริง</b> {{round($variable_station['actual_rainfall'], 2)}} มิลลิเมตร
					<br><b>ทำนายคลาดเคลื่อน</b> <span class="text-danger">{{round(abs($variable_station['actual_rainfall'] - $variable_station['predict_rainfall']), 2)}}</span> มิลลิเมตร
				</p>
				@endif
				<a href="{{url().'/forecast/'.$station_id}}" class="btn btn-success btn-block">
					ดูผลการพยากรณ์ของสถานีนี้ &raquo;
				</a>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-sm-12 text-left">
				<div>
					<div class="pull-right text-right">
						<label>เลือกเวลา</label>
						<br>
						<select class="form-control" id="choose-time">
							<option value="00">00 GMT</option>
							<option value="06">06 GMT</option>
							<option value="12">12 GMT</option>
							<option value="18">18 GMT</option>
						</select>
					</div>
					<h3>ค่าของตัวแปรที่ใช้ทำนาย</h3>
					<p>ตามข้อมูลจากระบบ NOAA CFSv2 Operational<sup><a href="">[?]</a></sup></p>
				</div>
				<table class="table">
					<thead>
						<tr>
							<th>ชื่อตัวแปร</th>
							<th>ระดับความสูง{{--<sup><a href="">[?]</a></sup>--}}</th>
							<th>เวลา{{--<sup><a href="">[?]</a></sup>--}}</th>
							<th>ค่าที่ได้</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Geopotential Height</td>
							<td>200mb</td>
							<td class="time">00 GMT</td>
							<td id="gph-200" class="t00">{{ round($variable_station['gph200_0'], 2) }} m</td>
							<td id="gph-200" class="t06">{{ round($variable_station['gph200_6'], 2) }} m</td>
							<td id="gph-200" class="t12">{{ round($variable_station['gph200_12'], 2) }} m</td>
							<td id="gph-200" class="t18">{{ round($variable_station['gph200_18'], 2) }} m</td>
						</tr>
						<tr>
							<td>Geopotential Height</td>
							<td>850mb</td>
							<td class="time">00 GMT</td>
							<td id="gph-850" class="t00">{{ round($variable_station['gph850_0'], 2) }} m</td>
							<td id="gph-850" class="t06">{{ round($variable_station['gph850_6'], 2) }} m</td>
							<td id="gph-850" class="t12">{{ round($variable_station['gph850_12'], 2) }} m</td>
							<td id="gph-850" class="t18">{{ round($variable_station['gph850_18'], 2) }} m</td>
						</tr>
						<tr>
							<td>Relative Humidity</td>
							<td>200mb</td>
							<td class="time">00 GMT</td>
							<td id="humidity-200" class="t00">{{ round($variable_station['h200_0'], 2) }}%</td>
							<td id="humidity-200" class="t06">{{ round($variable_station['h200_6'], 2) }}%</td>
							<td id="humidity-200" class="t12">{{ round($variable_station['h200_12'], 2) }}%</td>
							<td id="humidity-200" class="t18">{{ round($variable_station['h200_18'], 2) }}%</td>
						</tr>
						<tr>
							<td>Relative Humidity</td>
							<td>850mb</td>
							<td class="time">00 GMT</td>
							<td id="humidity-850" class="t00">{{ round($variable_station['h850_0'], 2) }}%</td>
							<td id="humidity-850" class="t06">{{ round($variable_station['h850_6'], 2) }}%</td>
							<td id="humidity-850" class="t12">{{ round($variable_station['h850_12'], 2) }}%</td>
							<td id="humidity-850" class="t18">{{ round($variable_station['h850_18'], 2) }}%</td>
						</tr>
						<tr>
							<td>Pressure</td>
							<td>Mean Sea Level</td>
							<td class="time">00 GMT</td>
							<td id="pressure-meansea" class="t00">{{ round($variable_station['p_msl_0'], 2) }} Pa</td>
							<td id="pressure-meansea" class="t06">{{ round($variable_station['p_msl_6'], 2) }} Pa</td>
							<td id="pressure-meansea" class="t12">{{ round($variable_station['p_msl_12'], 2) }} Pa</td>
							<td id="pressure-meansea" class="t18">{{ round($variable_station['p_msl_18'], 2) }} Pa</td>
						</tr>
						<tr>
							<td>Pressure</td>
							<td>Surface Level</td>
							<td class="time">00 GMT</td>
							<td id="pressure-surface" class="t00">{{ round($variable_station['p_sfl_0'], 2) }} Pa</td>
							<td id="pressure-surface" class="t06">{{ round($variable_station['p_sfl_6'], 2) }} Pa</td>
							<td id="pressure-surface" class="t12">{{ round($variable_station['p_sfl_12'], 2) }} Pa</td>
							<td id="pressure-surface" class="t18">{{ round($variable_station['p_sfl_18'], 2) }} Pa</td>
						</tr>
						<tr>
							<td>Temperature</td>
							<td>200 mb</td>
							<td class="time">00 GMT</td>
							<td id="temp-200" class="t00">{{ round($variable_station['temp200_0'], 2) }} K</td>
							<td id="temp-200" class="t06">{{ round($variable_station['temp200_6'], 2) }} K</td>
							<td id="temp-200" class="t12">{{ round($variable_station['temp200_12'], 2) }} K</td>
							<td id="temp-200" class="t18">{{ round($variable_station['temp200_18'], 2) }} K</td>
						</tr>
						<tr>
							<td>Temperature</td>
							<td>850 mb</td>
							<td class="time">00 GMT</td>
							<td id="temp-850" class="t00">{{ round($variable_station['temp850_0'], 2) }} K</td>
							<td id="temp-850" class="t06">{{ round($variable_station['temp850_6'], 2) }} K</td>
							<td id="temp-850" class="t12">{{ round($variable_station['temp850_12'], 2) }} K</td>
							<td id="temp-850" class="t18">{{ round($variable_station['temp850_18'], 2) }} K</td>
						</tr>
						<tr>
							<td>U-Component of Wind</td>
							<td>200 mb</td>
							<td class="time">00 GMT</td>
							<td id="uwind-200" class="t00">{{ round($variable_station['u200_0'], 2) }} m/s</td>
							<td id="uwind-200" class="t06">{{ round($variable_station['u200_6'], 2) }} m/s</td>
							<td id="uwind-200" class="t12">{{ round($variable_station['u200_12'], 2) }} m/s</td>
							<td id="uwind-200" class="t18">{{ round($variable_station['u200_18'], 2) }} m/s</td>
						</tr>
						<tr>
							<td>U-Component of Wind</td>
							<td>850 mb</td>
							<td class="time">00 GMT</td>
							<td id="uwind-850" class="t00">{{ round($variable_station['u850_0'], 2) }} m/s</td>
							<td id="uwind-850" class="t06">{{ round($variable_station['u850_6'], 2) }} m/s</td>
							<td id="uwind-850" class="t12">{{ round($variable_station['u850_12'], 2) }} m/s</td>
							<td id="uwind-850" class="t18">{{ round($variable_station['u850_18'], 2) }} m/s</td>
						</tr>
						<tr>
							<td>V-Component of Wind</td>
							<td>200 mb</td>
							<td class="time">00 GMT</td>
							<td id="vwind-200" class="t00">{{ round($variable_station['v200_0'], 2) }} m/s</td>
							<td id="vwind-200" class="t06">{{ round($variable_station['v200_6'], 2) }} m/s</td>
							<td id="vwind-200" class="t12">{{ round($variable_station['v200_12'], 2) }} m/s</td>
							<td id="vwind-200" class="t18">{{ round($variable_station['v200_18'], 2) }} m/s</td>
						</tr>
						<tr>
							<td>V-Component of Wind</td>
							<td>850 mb</td>
							<td class="time">00 GMT</td>
							<td id="vwind-850" class="t00">{{ round($variable_station['v850_0'], 2) }} m/s</td>
							<td id="vwind-850" class="t06">{{ round($variable_station['v850_6'], 2) }} m/s</td>
							<td id="vwind-850" class="t12">{{ round($variable_station['v850_12'], 2) }} m/s</td>
							<td id="vwind-850" class="t18">{{ round($variable_station['v850_18'], 2) }} m/s</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</form>
@stop


@section('script')
<script>
$(document).ready(function(){
	@if(isset($station_id))
	$('#station').val("{{$station_id}}");
	@endif
	@if(isset($date))
	$('#date').val("{{$date}}");
	@endif

	var rainfall = parseInt($('#rainfall').text());
	var droplets = 0;
	var dropletString = ""

	if(rainfall < 0.1) droplets = 0;
	else if(rainfall < 10.0) droplets = 1;
	else if(rainfall < 35.0) droplets = 2;
	else if(rainfall < 90.0) droplets = 3;
	else droplets = 4;

	if(rainfall < 0.1) $('#droplets').attr('title', 'ไม่มีฝน');
	else if(rainfall < 10.0) $('#droplets').attr('title', 'ฝนตกเล็กน้อย');
	else if(rainfall < 35.0) $('#droplets').attr('title', 'ฝนตกปานกลาง');
	else if(rainfall < 90.0) $('#droplets').attr('title', 'ฝนตกหนัก');
	else $('#droplets').attr('title', 'ฝนตกหนักมาก');

	for(var i = 0; i < 4; i++){
		if(i < droplets)
		dropletString += '<span class="glyphicon glyphicon-tint droplet"></span>';
		else
		dropletString += '<span class="glyphicon glyphicon-tint no-droplet"></span>';
	}
	$('#droplets').html(dropletString);

	$('.t06, .t12, .t18').hide();
	$('#choose-time').change(function(){
		var time =  $(this).val();
		$('.time').text(time + ' GMT');
		$('.t00, .t06, .t12, .t18').hide(0, function(){
			$('.t' + time).show();
		});
	});
});

var svg = dimple.newSvg("#chart", 380, 700);
var data = {!! json_encode($map_data) !!};
for(d of data){
	if(d.station_id == "{{$station_id}}")
	d.active = "active";
	else
	d.active = "inactive";
}

var myChart = new dimple.chart(svg, data);

myChart.setMargins("10px", "20px", "0px", "0px");
var x = myChart.addMeasureAxis("x", "longitude");
var y = myChart.addMeasureAxis("y", "latitude");
var z = myChart.addMeasureAxis("z", "rainfall");
var c = myChart.addMeasureAxis("c", "rainfall");

myChart.defaultColors = [
	new dimple.color("#459cea", "#459cea", 1), // blue
];

x.overrideMin = 97;
x.overrideMax = 105;
x.clamp = false;
y.overrideMin = 6;
y.overrideMax = 20;
y.clamp = false;
z.overrideMin = -3;
z.overrideMax = 60;

myChart.addSeries(["station_id", "station_name", "active"], dimple.plot.bubble);
myChart.assignColor("active", "red");
myChart.addLegend(180, 10, 360, 20, "right");
myChart.draw();
</script>
@stop
