@extends('template.master')

@section('page-header')
    <h1>การศึกษาการคาดการณ์<br>ปริมาณฝนรายวัน สำหรับประเทศไทย</h1>
    <p>ด้วยข้อมูลภูมิอากาศจาก CFSv2 และข้อมูลฝนกรมจากอุตุนิยมวิทยา</p>
    <br>
    <a class="btn btn-primary btn-lg" href="{{url().'/forecast'}}">ดูผลการพยากรณ์ &raquo;</a>
@stop
