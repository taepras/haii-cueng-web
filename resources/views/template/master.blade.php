<!DOCTYPE html>
<html>
<head>
	<title>Rain Prediction using R</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="{{url().'/js/jquery-1.11.3.min.js'}}" charset="utf-8"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link href="{{url().'/css/c3.min.css'}}" rel="stylesheet" type="text/css">
	<link href="{{url().'/css/haii-web.css'}}" rel="stylesheet" type="text/css">
	<link href="{{url().'/fonts/boon.css'}}" rel="stylesheet" type="text/css">
	<script src="{{url().'/js/d3.min.js'}}" charset="utf-8"></script>
	<script src="{{url().'/js/c3.min.js'}}"></script>
	<script src="{{url().'/js/dimple.latest.min.js'}}"></script>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					MENU <span class="caret"></span>
				</button>
				<a class="navbar-brand visible-xs" href="#">ระบบพยากรณ์ปริมาณฝนฯ</a>
			</div>
			<div class="collapse navbar-collapse" id="main-nav">
				<ul class="nav navbar-nav">
					<li><a href="{{url()}}">หน้าแรก</a></li>
					<li><a href="{{url().'/forecast'}}">ผลการพยากรณ์</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							รายละเอียดการพยากรณ์ <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="{{url().'/methodology'}}">วิธีการพยากรณ์</a></li>
							<li><a href="{{url().'/test_results'}}">ผลการทดสอบ</a></li>
						</ul>
					</li>
					<li><a href="{{url().'/about'}}">เกี่ยวกับโครงการ</a></li>
					@if(isset($user) && $user)
					<li>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-user"></span> {{$user->username}} <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="{{url().'/change_password'}}">เปลี่ยนรหัสผ่าน</a></li>
							<li><a href="{{url().'/logout'}}">ออกจากระบบ</a></li>
						</ul>
					</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
	<div class="container text-center">
		<div class="row">
			@yield('page-header')
		</div>
		<br><br><br>
		@yield('divider')
		<div class="row">
			@yield('content')
		</div>
	</div>
	<footer class="container">
		<hr>
		<div class="row">
			<div class="col-sm-12 text-center">
				<img src="{{url().'/img/logo_haii.gif'}}" style="height:100px; max-width:90%">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<img src="{{url().'/img/logo_chulaengineering.png'}}" style="height:50px; max-width:90%">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 text-center">
				<br>


				@if(isset($user) && $user)
				<span class="glyphicon glyphicon-user"></span> <b>{{$user->username}}</b> &nbsp; <a href="{{url().'/change_password'}}">เปลี่ยนรหัสผ่าน</a> | <a href="{{url().'/logout'}}">ออกจากระบบ</a>
				@else
				<a href="{{url().'/login'}}">เข้าสู่ระบบ</a> เพื่อดูข้อมูลปริมาณฝนเพิ่มเติม
				@endif
			</div>
		</div>
	</footer>
</body>
</html>

@yield('script')
