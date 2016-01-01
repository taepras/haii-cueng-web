@extends('template.master')


@section('page-header')
<h1>ผลการทดสอบ</h1>
<p>ค่าสถิติของผลการทดสอบการพยากรณ์ปริมาณฝน</p>
@stop


@section('content')
<hr>
<div class="col-sm-5">
    <h4><b>ภาพรวมผลการทดสอบ Model</b></h4>
    <div class="btn-group" role="group">
        {{-- <button type="button" class="btn btn-default active">Accuracy</button> --}}
        <a href="#" class="btn btn-default active" id="rmse">RMSE</a>
        <a href="#" class="btn btn-default" id="f1_score">F1 Score</a>
    </div>
    <div id="rmse-chart"></div>
	<div id="f1_score-chart"></div>
</div>
<div class="col-sm-7">
    <div class="row">
        <div class="col-sm-12">
            <h3>สถิติการทดสอบโดยรวม</h3>
        </div>
        <div class="col-sm-6">
            <p>Root Mean Square Error (RMSE)</p>
            <h1 class="huge-text" id="rmse-value"></h1>
            <p>มิลลิเมตร</p>
        </div>
        <div class="col-sm-6">
            <p>F1 Score</p>
            <h1 class="huge-text" id="f1_score-value"></h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12 text-left">
            <h3>ดูผลการทดสอบรายสถานี</h3>
            <p>เรียงตามชื่อจังหวัดตามตัวอักษร</p>
            <table class="table">
                <thead>
                    <tr>
                        <th>ชื่อสถานี</th>
                        <th>อำเภอ</th>
                        <th>จังหวัด</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($info_station as $id => $station)
                    <tr class="station" data-id="{{$id}}">
                        <td>{{$station->station_name}}</td>
                        <td>{{$station->district ? $station->district : 'N/A'}}</td>
                        <td>{{$station->province ? $station->province : 'N/A'}}</td>
                        <td class="text-right">
                            <a href="{{url().'/test_results/'.$station->station_id}}" class="btn btn-primary btn-xs">
                                ดูผล &raquo;
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center">
                <ul class="pagination pagination-sm">
                    <li>
                        <a href="#" aria-label="Previous" class="prev">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    @for($i = 1; $i <= 13; $i++)
                    <li><a href="#" data-page="{{$i}}" class="page">{{$i}}</a></li>
                    @endfor
                    <li>
                        <a href="#" aria-label="Next"  class="next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@stop


@section('script')
<script>
const stations_per_page = 10;
const min_page = 11;
const max_page = 13;
var current_page = 1;

function updatePage(){
    $('.station').each(function(){
        if($(this).attr('data-id') > (current_page - 1) * stations_per_page &&
           $(this).attr('data-id') <= (current_page) * stations_per_page)
            $(this).show();
        else
            $(this).hide();
    });
    $('.pagination a').each(function(){
        if($(this).attr('data-page') == current_page)
            $(this).parent().addClass('active');
        else
            $(this).parent().removeClass('active');
    });
}

var data = {!! json_encode($info_station) !!};

var rmse_svg = dimple.newSvg("#rmse-chart", 380, 700);
var rmse_chart = new dimple.chart(rmse_svg, data);
rmse_chart.setMargins("10px","20px","0px","0px");
// rmse_chart.setMargins("40px","20px","20px","40px");
var rmse_x = rmse_chart.addMeasureAxis("x", "longitude");
var rmse_y = rmse_chart.addMeasureAxis("y", "latitude");
var rmse_z = rmse_chart.addMeasureAxis("z", "rmse");
var rmse_c = rmse_chart.addMeasureAxis("c", "rmse");
rmse_chart.defaultColors = [new dimple.color("#be3e49", "#be3e49", 1)];
rmse_x.overrideMin = 97;
rmse_x.overrideMax = 105;
rmse_x.clamp = false;
rmse_y.overrideMin = 6;
rmse_y.overrideMax = 20;
rmse_y.clamp = false;
rmse_z.overrideMin = -2;
rmse_z.overrideMax = 40;
rmse_chart.addSeries(["latitude", "station_id", "station_name"], dimple.plot.bubble);
rmse_chart.draw();

var f1_svg = dimple.newSvg("#f1_score-chart", 380, 700);
var f1_chart = new dimple.chart(f1_svg, data);
f1_chart.setMargins("10px","20px","0px","0px");
var f1_x = f1_chart.addMeasureAxis("x", "longitude");
var f1_y = f1_chart.addMeasureAxis("y", "latitude");
var f1_z = f1_chart.addMeasureAxis("z", "f1_score");
var f1_c = f1_chart.addMeasureAxis("c", "f1_score");
f1_chart.defaultColors = [new dimple.color("#2ec135", "#2ec135", 1),];
f1_x.overrideMin = 97;
f1_x.overrideMax = 105;
f1_x.clamp = false;
f1_y.overrideMin = 6;
f1_y.overrideMax = 20;
f1_y.clamp = false;
f1_z.overrideMin = -20;
f1_z.overrideMax = 300;
f1_c.overrideMin = 0;
f1_c.overrideMax = 100;
f1_chart.addSeries(["latitude", "station_id", "station_name"], dimple.plot.bubble);
f1_chart.draw();

$.getJSON( "{{asset('json/test_statistics.json')}}", function( stat ) {
	$('#rmse-value').text(stat.rmse.toFixed(2));
	$('#f1_score-value').text(stat.f1_score.toFixed(1) + '%');
});

$(document).ready(function(){
    updatePage();

    $('.pagination a.page').click(function(e){
        e.preventDefault();
        current_page = $(this).attr('data-page');
        updatePage();
    });

    $('.pagination a.next').click(function(e){
        e.preventDefault();
        if(current_page < max_page)
            current_page++;
        updatePage();
    });

    $('.pagination a.prev').click(function(e){
        e.preventDefault();
        if(current_page > min_page)
            current_page--;
        updatePage();
    });

	$('#f1_score-chart').hide();

	$('#rmse, #f1_score').click(function(e){
		e.preventDefault();
		var _this = $(this);
		$('#rmse, #f1_score').removeClass('active', function(){
			$('#' + _this.attr('id')).addClass('active');
		});
	});

	$('#rmse').click(function(e){
		e.preventDefault();
		$('#rmse-chart').show();
		$('#f1_score-chart').hide();
	});

	$('#f1_score').click(function(e){
		e.preventDefault();
		$('#f1_score-chart').show();
		$('#rmse-chart').hide();
	});
});
</script>
@stop
