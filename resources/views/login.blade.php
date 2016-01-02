@extends('template.master')

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