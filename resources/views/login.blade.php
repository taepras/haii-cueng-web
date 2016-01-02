@extends('template.master')

<<<<<<< HEAD
{{--@section('css-for-master')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@stop--}}

@section('content')
    <div class = "container-fluid">
        <div class="wrapper">
            <form action="{{url().'/login'}}" method="post" name="Login_Form" class="form-signin">
                {{csrf_field()}}
                <h3 class="form-signin-heading">Sign In</h3>
                <hr class="colorbar"><br>
                @if($hasError == true)
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="alert alert-danger" role="alert">Error: Invalid user id or password.</div>
                        </div>
                    </div>
                @endif
                <input type="text" class="form-control" name="student-id" placeholder="User ID" required autofocus="" />
                <input type="password" class="form-control" name="pwd" placeholder="Password" required=""/>
                <div class="checkbox"><label><input type="checkbox" name="remember" value="true">remember-me</label></div>
                <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit">Login</button>
            </form>
        </div>
    </div>
@stop
=======

@section('page-header')
<h1>เข้าสู่ระบบ</h1>
@stop

@section('content')
<div class="col-sm-6 col-sm-offset-3">
	<div class="alert alert-danger" role="alert"><b>ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง</b> กรุณาลองใหม่อีกครั้ง</div>
	<form class="form-horizontal" method="post" action="{{url().'/login'}}">
		{!! csrf_field() !!}
		<div class="form-group">
			<label for="old-password" class="col-sm-3">ชื่อผู้ใช้</label>
			<div class="col-sm-9">
				<input type="text" name="old-password" id="old-password" class="form-control" placeholder="ชื่อผู้ใช้">
			</div>
		</div>
		<div class="form-group">
			<label for="new-password" class="col-sm-3">รหัสผ่าน</label>
			<div class="col-sm-9">
				<input type="password" name="new-password" id="new-password" class="form-control" placeholder="รหัสผ่าน">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<button type="submit" class="btn btn-primary btn-block">เข้าสู่ระบบ</button>
			</div>
		</div>
	</form>
</div>
@stop
>>>>>>> ca76d9cfb0b95a7e64f122994815e019309ae029
