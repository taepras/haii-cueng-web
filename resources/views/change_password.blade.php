@extends('template.master')


@section('page-header')
<h1>เปลี่ยนรหัสผ่าน</h1>
<p>เปลี่ยนรหัสผ่านของบัญชี <b>{{$user->username}}</b></p>
@stop

@section('content')
<div class="col-sm-6 col-sm-offset-3">
	@if(isset($error))
		@if($error == 'wrong password')
		<div class="alert alert-danger" role="alert"><b>รหัสผ่านเดิมไม่ถูกต้อง</b> กรุณาลองใหม่อีกครั้ง</div>
		@elseif($error == 'password mismatch')
		<div class="alert alert-danger" role="alert"><b>รหัสผ่านใหม่ไม่ตรงกัน</b> กรุณาลองใหม่อีกครั้ง</div>
		@elseif($error == 'blank field')
		<div class="alert alert-danger" role="alert">กรุณากรอกข้อมูลให้ครบทุกช่อง</div>
		@endif
	@endif
	<form class="form-horizontal" method="post" action="{{url().'/change_password'}}">
		{!! csrf_field() !!}
		<div class="form-group">
			<label for="old-password" class="col-sm-4">รหัสผ่านเดิม</label>
			<div class="col-sm-8">
				<input type="password" name="old-password" id="old-password" class="form-control" placeholder="รหัสผ่านเดิม">
			</div>
		</div>
		<div class="form-group">
			<label for="new-password" class="col-sm-4">รหัสผ่านใหม่</label>
			<div class="col-sm-8">
				<input type="password" name="new-password" id="new-password" class="form-control" placeholder="รหัสผ่านใหม่">
			</div>
		</div>
		<div class="form-group">
			<label for="old-password" class="col-sm-4">ยืนยันรหัสผ่านใหม่</label>
			<div class="col-sm-8">
				<input type="password" name="confirm-new-password" id="confirm-new-password" class="form-control" placeholder="ยืนยันรหัสผ่านใหม่">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<button type="submit" class="btn btn-primary btn-block">เปลี่ยนรหัสผ่าน</button>
			</div>
		</div>
	</form>
</div>
@stop
