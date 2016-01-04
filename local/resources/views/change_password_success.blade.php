@extends('template.master')

@section('page-header')
<h1>เปลี่ยนรหัสผ่านเรียบร้อย</h1>
<p>เปลี่ยนรหัสผ่านของบัญชี <b>{{$user->username}}</b> เรียบร้อยแล้ว</p>
<br>
<a class="btn btn-link" href="{{url().'/'}}">&laquo; กลับไปหน้าแรก</a>
@stop
