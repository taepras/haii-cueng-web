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
				<label class="light-label col-sm-3">เลือกสถานี</label>
				<div class="col-sm-9">
					@include('partials.station_selector')
				</div>
			</div>
			<div class="form-group">
				<label class="light-label col-sm-3">ปริมาณฝน ตั้งแต่วันที่</label>
				<div class="col-sm-4">
					<input type="date" class="form-control" name="start_date" id="start_date">
				</div>
				<label class="light-label col-sm-1">ถึง</label>
				<div class="col-sm-4">
					<input type="date" class="form-control" name="end_date" id="end_date">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-9 col-sm-offset-3">
					<p class="help-block">
						มีข้อมูลเฉพาะในช่วงวันที่
						<b>{{date("d/m/Y", strtotime($info_station['start_date']))}}</b>
						ถึงวันที่
						<b>{{date("d/m/Y", strtotime($info_station['end_date']))}}</b>
					</p>
				</div>
			</div>
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
			<div class="col-sm-7 text-left">
				<h3>เลือกดูตัวแปรที่ใช้ทำนาย</h3>
				<p>ตามข้อมูลจากระบบ NOAA CFSv2 Operational<sup><a href="">[?]</a></sup></p>
				<div class="form-horizontal">
					@if($user)
					<div for="show_actual" class="form-group">
						<label class="col-sm-3 control-label">ปริมาณฝนจริง</label>
						<div class="col-sm-9" style="padding-top:7px">
							@if(isset($hasActual) && $hasActual)
							<input type="checkbox" name="show_actual" id="show_actual">
							<label for="show_actual" class="light-label">แสดงปริมาณฝนจริงบนกราฟ</label>
							@else
							ไม่มีข้อมูลปริมาณฝนจริงในช่วงเวลานี้
							@endif
						</div>
					</div>
					@endif
					<div class="form-group">
						<label for="show_variable" class="col-sm-3 control-label">ดูปริมาณฝนคู่กับ</label>
						<div class="col-sm-9">
							<select class="form-control" id="show_variable">
								<option value="">แสดงปริมาณฝนที่ทำนายได้อย่างเดียว</option>
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
var chartInitialConfig, chartConfig, chart;

$.getJSON( "{{asset('json/variable_description.json')}}", function( description ) {
	if(!$.isEmptyObject(dataset)){
		// console.log(dataset);
		@foreach($data as $key => $val)
		dataset.{{$key}} = ['{{$key}}'].concat(dataset.{{$key}});
		@endforeach
		chartInitialConfig = {
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
		chart = c3.generate(chartInitialConfig);

		function generateChart(varName, showActual){
			showActual = typeof showActual !== 'undefined' ? showActual : false;

			chartConfig = $.extend(true,{},chartInitialConfig);

			if(varName){
				chartConfig.data.columns.push(dataset[varName]);
				chartConfig.data.axes[varName] = 'y2';
				chartConfig.axis.y2 = {label: '', show: true};
				chartConfig.axis.y2.label = (
					description[varName].desc +
					' @' + description[varName].level +
					', ' + description[varName].time + ' GMT' +
					' (' + description[varName].unit + ')'
				);
			}

			if(showActual){
				chartConfig.data.columns.push(dataset.actual_rainfall);
				chartConfig.data.axes.actual_rainfall = 'y';
			}

			chart = c3.generate(chartConfig);
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

		$('#show_variable, #time, #show_actual').change(function(){
			var varString = $('#show_variable').val();

			if(varString){
				varString += "_";
				varString += $('#time').val();
			}
			var showActual = $('#show_actual').prop('checked');
			generateChart(varString, showActual);
		});

		$('#config-form').attr('action', window.location.href + "#graph");
		$('#station').change(function(){
			if($(this).val())
			$('#config-form').attr('action', "{{url().'/forecast/'}}" + $(this).val());
			else
			$('#config-form').attr('action', window.location.href + "#graph");
		});
	});
});
</script>
@stop
