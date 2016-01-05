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
		@if(isset($success) && $success)
			<div class="alert alert-success" role="alert">นำเข้าข้อมูลเรียบร้อย</div>
		@endif
		@if(isset($error))
			<div class="alert alert-danger" role="alert">{{$error}}</div>
		@endif
		<form role="form" class="form-horizontal" method="post" action="{{url().'/upload'}}" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="form-group">
				<label class="col-sm-3">ไฟล์ .csv</label>
				<div class="col-sm-9">
					<input type="file" name="file" accept="text/csv">
				</div>
			</div>
			<button type="submit" class="btn btn-primary btn-block" id="upload-file">
				นำเข้าข้อมูล
			</a>
		</form>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-sm-6 col-sm-offset-3">
		<h4><b>ไฟล์ csv ที่รองรับ</b></h4>
		<div class="text-left">
			<p>บรรทัดแรกของไฟล์จะมีชื่อคอลัมน์ ซึ่งมีคอลัมน์ต่างๆ ที่รองรับดังนี้</p>
			<ul>
				<li><code>station_id</code>*&nbsp;&nbsp;คือรหัสของสถานีตรวจวัดปริมาณน้ำฝน เช่น 300201 แทนสถานีแม่ฮ่องสอน</li>
				<li><code>date</code>*&nbsp;&nbsp;คือวันที่ของข้อมูลชุดนี้ เช่น 2012-06-02</li>
				<li><code>gph200_[T]</code>,
					<code>gph850_[T]</code>,
					<code>h200_[T]</code>,
					<code>h850_[T]</code>,
					<code>p_msl_[T]</code>,
					<code>p_sfl_[T]</code>,
					<code>temp200_[T]</code>,
					<code>temp850_[T]</code>,
					<code>u200_[T]</code>,
					<code>u850_[T]</code>,
					<code>v200_[T]</code>,
					<code>v850_[T]</code>
					&nbsp;&nbsp;คือค่าของตัวแปรต่างๆ ที่ระดับความสูงต่างๆ ณ เวลา <b><em>T</em></b> GMT (T มีค่าได้ดังนี้ 0, 6, 12, 18)</li>
				<li><code>actual_rainfall</code>&nbsp;&nbsp;คือค่าปริมาณฝนจริงเป็นมิลลิเมตรในวันที่ระบุ</li>
				<li><code>predict_rainfall</code>*&nbsp;&nbsp;คือค่าปริมาณฝนเป็นมิลลิเมตรที่ทำนายได้</li>
			</ul>
			<p class="text-right"><em>เครื่องหมาย * คือจำเป็นต้องมีเพื่อให้ระบบทำงานได้อย่างถูกต้อง</em></p>
			<p>บรรทัดต่อๆ มาของไฟล์ .csv คือข้อมูลของตัวแปรในคอลัมน์นั้นๆ</p>
			<p><b>หมายเหตุ</b> ไฟล์ .csv ที่ต้องการนำเข้าอาจจะมีคอลัมน์อื่นนอกเหนือจากนี้ได้ แต่ข้อมูลในคอลัมน์เหล่านั้นจะไม่ถูกนำเข้ามาในระบบ</p>
		</div>
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

	$('#upload-file').click(function(){
		$(this).addClass('disabled');
		$(this).html('กำลังประมวลผล กรุณารอสักครู่ <img src="{{asset('img/loader.gif')}}">');
	});
});
</script>
@stop
