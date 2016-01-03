@extends('template.master')


@section('page-header')
<h1 style="margin-bottom:-15px;">ดาวน์โหลด</h1>
@stop


@section('content')
<hr>
<div class="row">
	<div class="col-sm-6 col-sm-offset-3">
		<h4><b>ดาวน์โหลดข้อมูลปริมาณฝนและข้อมูล CFSv2</b></h4>
		<br>
		<form role="form" class="form-horizontal" id="download-cfs-form">
			<div class="form-group">
				<label class="col-sm-3">เลือกสถานี</label>
				<div class="col-sm-9">
					@include('partials.station_selector')
				</div>
			</div>
			{{--
				TODO make users able to specify date range of download...
				also make them know about the available range.
			 --}}
			<a href="#" class="btn btn-primary btn-block" id="download-cfs-button" download>
				ดาวน์โหลด .csv
				<span id="cfs-icon" class="glyphicon glyphicon-download-alt"></span>
				<img src="{{asset('img/loader.gif')}}" id="cfs-loader" style="display:none">
			</a>
		</form>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-sm-6 col-sm-offset-3">
		<h4><b>ดาวน์โหลดข้อมูลสถานีตรวจวัดปริมาณน้ำฝน</b></h4>
		<br>
		<a href="{{url().'/downloads/stations'}}" class="btn btn-primary btn-block" id="download-stations-button" download>
			ดาวน์โหลด .csv
			<span id="stations-icon" class="glyphicon glyphicon-download-alt"></span>
			<img src="{{asset('img/loader.gif')}}" id="stations-loader" style="display:none">
		</a>
	</div>
</div>
@stop

@section('script')
<script>
$(document).ready(function(){
	var cfs_link = $('#download-cfs-button').attr('href');

	$('#download-cfs-form *').change(function(){
		var new_cfs_link = '{{url().'/downloads'}}' + '/cfsv2/' + $('#station').val() + '.csv';
		$('#download-cfs-button').attr('href', new_cfs_link);
	});

	$('#download-cfs-button').click(function(e){
		if($(this).attr('href') == cfs_link){
			alert('กรุณาเลือกสถานีที่ต้องการดาวน์โหลด');
			e.preventDefault();
		}else{
			$(this).text('กำลังประมวลผล กรุณารอสักครู่...');
			$(this).addClass('disabled');
		}
	});

	$('#download-stations-button').click(function(){
		$(this).text('กำลังประมวลผล กรุณารอสักครู่...');
		$(this).addClass('disabled');
		// $('#stations-icon').hide();
		// $('#stations-loader').show();
	});
});
</script>
@stop
