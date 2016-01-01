@extends('template.master')


@section('page-header')
    <h1>ระบบพยากรณ์ปริมาณฝนในประเทศไทย</h1>
    <p>โดยวิธี Data Mining บนข้อมูลภูมิอากาศจาก CFSv2 และข้อมูลฝนกรมจากอุตุนิยมวิทยา</p>
    <br>
    <a class="btn btn-primary btn-lg" href="{{url().'/forecast'}}">ดูผลการพยากรณ์ &raquo;</a>
@stop


@section('divider')
{{-- <hr> --}}
@stop


@section('content')
{{-- <div class="col-sm-4" style="background-color:#eee; height:500px;">
    asdf;lkajsdf;lkj
</div>
<div class="col-sm-4" style="background-color:#ddd; height:500px;">
    asdf;lkajsdf;lkj
</div>
<div class="col-sm-4" style="background-color:#eee; height:500px;">
    asdf;lkajsdf;lkj
</div> --}}
@stop
