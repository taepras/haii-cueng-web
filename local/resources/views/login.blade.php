@extends('template.master')

@section('page-header')
<h1>เข้าสู่ระบบ</h1>
@stop

@section('content')
<div class="col-sm-6 col-sm-offset-3">
	@if($hasError)
		<div class="alert alert-danger" role="alert"><b>ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง</b> กรุณาลองใหม่อีกครั้ง</div>
	@endif
	<form class="form-horizontal" method="post" action="{{url().'/login'}}" name="Login_Form">
		{!! csrf_field() !!}
		<div class="form-group">
			<label for="old-password" class="col-sm-3">ชื่อผู้ใช้</label>
			<div class="col-sm-9">
				<input type="text" name="student-id" id="username" class="form-control" placeholder="ชื่อผู้ใช้" required autofocus="">
			</div>
		</div>
		<div class="form-group">
			<label for="new-password" class="col-sm-3">รหัสผ่าน</label>
			<div class="col-sm-9">
				<input type="password" name="pwd" id="password" class="form-control" placeholder="รหัสผ่าน">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<button type="submit" class="btn btn-primary btn-block" value="Login">เข้าสู่ระบบ</button>
			</div>
		</div>
	</form>
</div>
@stop
