@extends('template.master')


@section('page-header')
<h1 style="margin-bottom:-15px;">เพิ่มข้อมูลฝน</h1>
@stop


@section('content')
<hr>
<div class="row">
	<div class="col-sm-6 col-sm-offset-3">
		<h4><b>อัพโหลดข้อมูล</b></h4>
		<br>
		<form role="form" class="form-horizontal" method="post" action="{{url().'/upload'}}" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="form-group">
				<label class="col-sm-3">ไฟล์ .csv</label>
				<div class="col-sm-9">
					<input type="file" name="file">
				</div>
			</div>
			<button type="submit" class="btn btn-primary btn-block">
				อัพโหลด .csv
			</a>
		</form>
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
