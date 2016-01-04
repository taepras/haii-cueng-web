@extends('template.master')


@section('page-header')
<h1>ผลการทดสอบ  </h1>
<p>ผลการทดสอบการพยากรณ์ปริมาณฝน ณ สถานีตรวจวัดปริมาณน้ำฝน <b>{{$info_station['station_name']}}</b></p>
@stop


@section('content')
<div class="row">
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
						@if($info_station['start_date'])
						มีข้อมูลเฉพาะในช่วงวันที่
						<b>{{date("d/m/Y", strtotime($info_station['start_date']))}}</b>
						ถึงวันที่
						<b>{{date("d/m/Y", strtotime($info_station['end_date']))}}</b>
						@else
						ไม่มีข้อมูลผลการทดสอบของสถานีนี้
						@endif
					</p>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<button type="submit" class="btn btn-primary btn-block">ดูข้อมูล &raquo;</button>
				</div>
			</div>
		</form>
	</div>
</div>
<hr>
@if($results)
<div class="row">
	<div class="col-sm-9">
		<div id="chart"></div>
	</div>
	<div class="col-sm-3 text-center">
		<h4><b>ค่าสถิติของส่วนที่เลือก</b></h4>
		<p>F1 Score</p>
		<h1 class="huge-text">{{round($f1_score * 100,2)}}%</h1>
		<hr>
		<p>Root Mean Square Error (RMSE)</p>
		<h1 class="huge-text">{{round($rmse, 2)}}</h1>
		<p>มิลลิเมตร</p>
		<hr>
		{{-- TODO add F1 & rmse column of each stations to stations table in database --}}
		<p>F1 Score เฉลี่ยของสถานีนี้ <b>{{$info_station['f1_score']}}%</b></p>
		<p>RMSE เฉลี่ยของสถานีนี้ <b>{{$info_station['rmse']}} mm</b></p>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<a href="{{url().'/test_results'}}">&laquo; กลับไปหน้าเลือกสถานี</a>
	</div>
</div>
@else
<br>
<h1>ไม่มีข้อมูลที่ท่านเลือก</h1>
<p>กรุณาเลือกสถานีหรือช่วงเวลาใหม่</p>
<br>
<br>
@endif
@stop


@section('script')
<script>
$(document).ready(function(){
	console.log({{$station_id}});
	@if(isset($station_id))
	$('#station').val("{{$station_id}}");
	@endif
	@if(isset($start_date))
	$('#start_date').val("{{$start_date}}");
	@endif
	@if(isset($end_date))
	$('#end_date').val("{{$end_date}}");
	@endif

	$('#config-form').attr('action', window.location.href + "#graph");
	$('#station').change(function(){
		if($(this).val())
			$('#config-form').attr('action', "{{url().'/test_results/'}}" + $(this).val());
		else
			$('#config-form').attr('action', window.location.href + "#graph");
	});
});


var chart = c3.generate({
	data: {
		x: 'date',
		json: {!! json_encode($results) !!},
		// url: '{{url().'/test/300201_edited_s.csv'}}',
		type: 'line',
		keys: {
			x: 'date', // it's possible to specify 'x' when category axis
			value: ['predict_rainfall', 'actual_rainfall', 'error'],
		},
		hide: ['error'],
		colors: {
            predict_rainfall: '#2e6da4',
            actual_rainfall: '#2ec135',
            error: '#be3e49'
        },
	},
	axis: {
		x: {
			type: 'timeseries',
			tick: {
				format: '%Y-%m-%d'
			}
		},
		y: {
			label: 'rainfall (mm)',
			position: 'outer-center'
		}
	},
	zoom: {
		enabled: true
	},
	size: {
		height: 400
	},
});
</script>
@stop
