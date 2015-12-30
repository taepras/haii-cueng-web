@extends('template.master')


@section('page-header')
<h1>ผลการพยากรณ์</h1>
<p>ผลการพยากรณ์ล่วงหน้า 9 เดือน ณ สถานีตรวจวัดปริมาณน้ำฝน <b>{{$info_station['station_name']}}</b></p>
@stop


@section('content')
<div class="row">
{{-- <form role="form" method="post" action="{{url().'/forecast/'.$station_id}}"> --}}
	<div class="col-sm-8 col-sm-offset-2" id="graph">
		<form class="form-horizontal text-left" method="post" action="" id="config-form">
			{{csrf_field()}}
			<div class="form-group">
				<label class="col-sm-3">เลือกสถานี</label>
				<div class="col-sm-9">
					@include('partials.station_selector')
				</div>
			</div>
			<div class="form-group">
				<label class="choose-date-label col-sm-3">ปริมาณฝน ตั้งแต่วันที่</label>
				<div class="col-sm-4">
					<input type="date" class="form-control" name="start_date" id="start_date">
				</div>
				<label class="choose-date-label col-sm-1">ถึง</label>
				<div class="col-sm-4">
					<input type="date" class="form-control" name="end_date" id="end_date">
				</div>
			</div>
			{{-- &nbsp;&nbsp; --}}
			<div class="form-group">
				<div class="col-sm-12">
					<button type="submit" class="btn btn-primary btn-block">ดูข้อมูล &raquo;</button>
				</div>
			</div>

			{{-- <button class="btn btn-primary">ดูข้อมูล &raquo;</button> --}}
		</form>
	</div>
</div>
	<hr>
	<div class="row">
	<div class="col-sm-12">
		<div id="chart"></div>
		<br><br>
	</div>
	<div class="col-sm-12">
		<div class="row">
			<div class="col-sm-5">
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
						{{-- <tr>
							<th>ข้อมูลตั้งแต่วันที่</th>
							<td>{{date("d/m/Y", strtotime($start_date))}}</td>
						</tr>
						<tr>
							<th>ข้อมูลถึงวันที่</th>
							<td>{{date("d/m/Y", strtotime($end_date))}}</td>
						</tr> --}}
					</table>
				</div>
			</div>
			<div class="col-sm-7 text-left">
				<h3>เลือกดูตัวแปรที่ใช้ทำนาย</h3>
				<p>ตามข้อมูลจากระบบ NOAA CFSv2 Operational<sup><a href="">[?]</a></sup></p>
				<div class="form-horizontal">
					<div class="form-group">
						<label for="show_variable" class="col-sm-3 control-label">ดูปริมาณฝนคู่กับ</label>
						<div class="col-sm-9">
							<select class="form-control" id="show_variable">
								<option value="">แสดงปริมาณฝนที่ทำนายได้อย่างเดียว</option>
								<option value="actual_rainfall">ปริมาณฝนจริงในวันดังกล่าว</option>
								<option value="gph200">Geopotential Height ที่ระดับความสูง 200mb</option>
								<option value="gph850">Geopotential Height ที่ระดับความสูง 850mb</option>
								<option value="h200">Relative Humidity ที่ระดับความสูง 200mb</option>
								<option value="h850">Relative Humidity ที่ระดับความสูง 850mb</option>
								<option value="temp200">Temperature ที่ระดับความสูง 200mb</option>
								<option value="temp850">Temperature ที่ระดับความสูง 850mb</option>
								<option value="p_msl">Pressure ที่ระดับความสูง mean sea level</option>
								<option value="p_sfl">Pressure ที่ระดับความสูง surface level</option>
								<option value="u200">U-Component of Wind ที่ระดับความสูง 200mb</option>
								<option value="u850">U-Component of Wind ที่ระดับความสูง 850mb</option>
								<option value="v200">V-Component of Wind ที่ระดับความสูง 200mb</option>
								<option value="v850">V-Component of Wind ที่ระดับความสูง 850mb</option>
							</select>
						</div>
					</div>
					<div for="time" class="form-group">
						<label class="col-sm-3 control-label">ที่เวลา</label>
						<div class="col-sm-9">
							<select class="form-control" id="time">
								<option value="0">0 GMT</option>
								<option value="6">6 GMT</option>
								<option value="12">12 GMT</option>
								<option value="18">18 GMT</option>
							</select>
						</div>
					</div>

				</div>
			</div>
			<div class="col-sm-12 text-center">
				<a href="{{url().'/forecast'}}" class="btn btn-link">&laquo; ย้อนกลับไปหน้าภาพรวมผลการพยากรณ์</a>
			</div>
		</div>
	</div>
</form>
@stop


@section('script')
<script>
var dataset = {!! json_encode($data) !!};
var description = $.getJSON("{{asset('json/variable_description.json')}}", function(data){
	console.log("JSON Loaded");
	console.log(data);
});
if(!$.isEmptyObject(dataset)){
	console.log(dataset);
	@foreach($data as $key => $val)
	dataset.{{$key}} = ['{{$key}}'].concat(dataset.{{$key}});
	@endforeach
	var chartInitialConfig = {
		data: {
			x: 'date',
			columns: [
				dataset.date,
				dataset.predict_rainfall,
			],
			type: 'line',
			axes: { predict_rainfall: 'y' }
		},
		axis: {
			x: {
				type: 'timeseries',
				tick: { format: '%Y-%m-%d' }
			},
			y: {
				label: 'rainfall(mm)',
				position: 'outer-center'
			},
		},
		zoom: { enabled: true }
	};
	var chart = c3.generate(chartInitialConfig);

	function generateChart(varName){
		if(varName){
			var chartConfig = {
				data: {
					x: 'date',
					columns: [
						dataset.date,
						dataset.predict_rainfall,
						dataset[varName],
					],
					type: 'line',
					axes: { predict_rainfall: 'y' }
				},
				axis: {
					x: {
						type: 'timeseries',
						tick: { format: '%Y-%m-%d' }
					},
					y: {
						label: 'rainfall (mm)',
						position: 'outer-center'
					},
					y2: {
						label: description[varName],
						position: 'outer-center',
						show: true
					}
				},
				zoom: {
					enabled: true
				}
			}
			chartConfig.data.axes[varName] = 'y2';
			chart = c3.generate(chartConfig);
		} else {
			chart = c3.generate(chartInitialConfig);
		}
	}
} else {
	$('#chart').html("\
		<h1>ไม่มีข้อมูลที่ท่านเลือก</h1>\
		<p>กรุณาเลือกสถานีหรือช่วงเวลาใหม่</p>\
		<br>\
		<hr>\
	");
}

$(document).ready(function(){
	@if(isset($station_id))
	$('#station').val("{{$station_id}}");
	@endif
	@if(isset($start_date))
	$('#start_date').val("{{$start_date}}");
	@endif
	@if(isset($end_date))
	$('#end_date').val("{{$end_date}}");
	@endif

	$('#show_variable, #time').change(function(){
		var varString = $('#show_variable').val();
		if(varString == 'actual_rainfall'){
			var chartConfig = chartInitialConfig;
			chartConfig.data.columns.push(dataset.actual_rainfall);
			chartConfig.data.axes = { predict_rainfall: 'y', actual_rainfall: 'y' };
			chart = c3.generate(chartConfig);
		} else {
			if(varString){
				varString += "_";
				varString += $('#time').val();
			}
			generateChart(varString);
		}
	});

	$('#config-form').attr('action', window.location.href + "#graph");
	$('#station').change(function(){
		if($(this).val())
			$('#config-form').attr('action', "{{url().'/forecast/'}}" + $(this).val());
		else
			$('#config-form').attr('action', window.location.href + "#graph");
	});
});
</script>
@stop
