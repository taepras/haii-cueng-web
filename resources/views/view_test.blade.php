@extends('template.master')


@section('page-header')
<h1>ผลการทดสอบ  </h1>
<p>ผลการทดสอบการพยากรณ์ปริมาณฝน ณ สถานีตรวจวัดปริมาณน้ำฝน <b>{{$info_station['station_name']}}</b></p>
@stop


@section('content')
<div class="row">
    <div class="col-sm-8 col-sm-offset-2">
        <form class="form-horizontal text-left" method="post" action="" id="config-form">
            {{csrf_field()}}
            <div class="form-group">
                <label class="col-sm-3">เลือกสถานี</label>
                <div class="col-sm-9">
                    @include('partials.station_selector')
                </div>
            </div>
            <div class="form-group">
                <label class="choose-date-label col-sm-3">ปริมาณฝน ตั้งแต่วันที่</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" name="start_date" id="start_date">
                </div>
                <label class="choose-date-label col-sm-1">ถึง</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" name="end_date" id="end_date">
                </div>
            </div>
            {{-- &nbsp;&nbsp; --}}
            <div class="form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary btn-block">ดูข้อมูล &raquo;</button>
                </div>
            </div>

            {{-- <button class="btn btn-primary">ดูข้อมูล &raquo;</button> --}}
        </form>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-9">
        <div id="chart"></div>
    </div>
    <div class="col-sm-3 text-center">
        <h4><b>ค่าสถิติของส่วนที่เลือก</b></h4>
        <p>F1 Score</p>
        <h1 class="huge-text">{{round($f1_score * 100,2)}}%</h1>
        <hr>
        <p>Root Mean Square Error (RMSE)</p>
        <h1 class="huge-text">{{round($rmse, 2)}}</h1>
        <p>มิลลิเมตร</p>
        <hr>
        {{-- TODO add F1 & rmse column of each stations to stations table in database --}}
        <p>F1 Score เฉลี่ยของสถานีนี้ <b>{{''}}</b></p>
        <p>RMSE เฉลี่ยของสถานีนี้ <b>{{''}}</b></p>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <a href="{{url().'/test_results'}}">&laquo; กลับไปหน้าเลือกสถานี</a>
    </div>
</div>
@stop


@section('script')
<script>
$(document).ready(function(){
    @if(isset($station_id))
    $('#station').val("{{$station_id}}");
    @endif
    @if(isset($start_date))
    $('#start_date').val("{{$start_date}}");
    @endif
    @if(isset($end_date))
    $('#end_date').val("{{$end_date}}");
    @endif

    $('#config-form').attr('action', window.location.href);
    $('#station').change(function(){
        if($(this).val())
            $('#config-form').attr('action', "{{url().'/test_results/'}}" + $(this).val());
        elsec
            $('#config-form').attr('action', window.location.href);
    });
});


var chart = c3.generate({
    data: {
        x: 'date',
        json: {!! json_encode($results) !!},
        // url: '{{url().'/test/300201_edited_s.csv'}}',
        type: 'line',
        keys: {
            x: 'date', // it's possible to specify 'x' when category axis
            value: ['predict_rainfall', 'actual_rainfall', 'error'],
        },
        hide: ['error']
        // x: 'date',
        // url: '{{url().'/csv/mocktest.csv'}}',
        // type: 'line',
        // hide: ['', 'error']
    },
    axis: {
        x: {
            type: 'timeseries',
            tick: {
                format: '%Y-%m-%d'
            }
        },
        y: {
            label: 'rainfall (mm)',
            position: 'outer-center'
        }
    },
    zoom: {
        enabled: true
    },
    size: {
        height: 400
    },
});
</script>
@stop
