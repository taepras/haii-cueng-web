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
        <button type="button" class="btn btn-default active">RMSE</button>
        <button type="button" class="btn btn-default">F1 Score</button>
    </div>
    <div id="chart"></div>
</div>
<div class="col-sm-7">
    <div class="row">
        <div class="col-sm-12">
            <h3>สถิติการทดสอบโดยรวม</h3>
        </div>
        <div class="col-sm-6">
            <p>Root Mean Square Error (RMSE)</p>
            <h1 class="huge-text">9.84</h1>
            <p>มิลลิเมตร</p>
        </div>
        <div class="col-sm-6">
            <p>F1 Score</p>
            <h1 class="huge-text">78.2%</h1>
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
                    @foreach($stations as $id => $station)
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
});

var svg = dimple.newSvg("#chart", 380, 700);

d3.csv("{{url().'/csv/mockweb.csv'}}", function (data) {
    var myChart = new dimple.chart(svg, data);


    myChart.setMargins("40px", "20px", "10px", "40px");
    var x = myChart.addMeasureAxis("x", "long");
    var y = myChart.addMeasureAxis("y", "lat");
    var z = myChart.addMeasureAxis("z", "rainfall");
    var c = myChart.addMeasureAxis("c", "rainfall");
    //var c = myChart.addMeasureAxis("c", 0);

    // myChart.defaultColors = [
    //       new dimple.color("#3498db", "#2980b9", 1), // blue
    //       new dimple.color("#e74c3c", "#c0392b", 1), // red
    //       new dimple.color("#2ecc71", "#27ae60", 1), // green
    //       new dimple.color("#9b59b6", "#8e44ad", 1), // purple
    //       new dimple.color("#e67e22", "#d35400", 1), // orange
    //       new dimple.color("#f1c40f", "#f39c12", 1), // yellow
    //       new dimple.color("#1abc9c", "#16a085", 1), // turquoise
    //       new dimple.color("#95a5a6", "#7f8c8d", 1)  // gray
    //   ];

    myChart.defaultColors = [
        new dimple.color("#459cea", "#459cea", 1), // blue
        //new dimple.color("rgba(59, 156, 234, 0.5)", "rgba(59, 156, 234, 0.5)", 1), // blue
    ];

    x.overrideMin = 97;
    x.overrideMax = 105;
    y.overrideMin = 6;
    y.overrideMax = 20;
    z.overrideMin = -3;
    z.overrideMax = 60;

    myChart.addSeries(["lat", "code"], dimple.plot.bubble);
    myChart.addLegend(180, 10, 360, 20, "right");
    myChart.draw();

    // svg.select("g").selectAll("g.dimple-gridline").filter(function (d, i) { return i === 1; })
    // .append("rect")
    // .attr("x", 0).attr("y", 0)
    // .attr("width", 380).attr("height", 700)
    // .style("fill", "rgba(0,0,0,0.1)");
});
</script>
@stop
