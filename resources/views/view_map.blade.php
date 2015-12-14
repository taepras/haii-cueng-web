@extends('template.master')


@section('page-header')
<h1>ผลการพยากรณ์</h1>
<p>ผลการพยากรณ์ปริมาณฝน ณ วันที่ {{$variable_station['date']}}</a></p>
@stop


@section('content')
<div class="col-sm-5">
    <h4><b>คลิกบนจุดข้อมูลในแผนที่เพื่อเลือกสถานีที่ต้องการ</b></h4>
    <div id="chart"></div>
</div>
<div class="col-sm-7">
    <div class="row">
        <div class="col-sm-12">
            <form role="form" class="form-inline">
                <label class="choose-date-label">เลือกดูปริมาณฝน ณ วันที่&nbsp;&nbsp;</label>
                <input type="date" class="form-control">
                &nbsp;&nbsp;
                <button type="submit" class="btn btn-default">ดูข้อมูล &raquo;</button>
            </form>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-6">
            <p>สถานีตรวจวัดปริมาณฝน</p>
            <h3 class="station-name"><b>{{$info_station['station_name']}}</b></h3>
            <div>
                <table class="table text-left">
                    <tr>
                        <th>ตำบล</th>
                        <td>{{$info_station['sub_district']}}</td>
                    </tr>
                    <tr>
                        <th>อำเภอ</th>
                        <td>{{$info_station['district']}}</td>
                    </tr>
                    <tr>
                        <th>จังหวัด</th>
                        <td>{{$info_station['province']}}</td>
                    </tr>
                    <!-- <b>ตำบล</b> ห้วยผา<br>
                    <b>อำเภอ</b> เมืองแม่ฮ่องสอน<br>
                    <b>จังหวัด</b> แม่ฮ่องสอน -->
                </table>
            </div>
        </div>
        <div class="col-sm-6">
            <p>
                ผลการพยากรณ์<br>
                ปริมาณฝน ณ วันที่ {{$variable_station['date']}}
            </p>
            <h1 class="huge-text" id="rainfall">52.7</h1>
            <p>
                มิลลิเมตร{{--<sup><a href="">[?]</a></sup>--}}
                <span id="droplets"></span>
            </p>
            <a href="{{url().'/forecast/300201'}}" class="btn btn-primary">
                ดูผลการพยากรณ์ของสถานีนี้ &raquo;
            </a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12 text-left">
            <h3>ค่าของตัวแปรที่ใช้ทำนาย</h3>
            <p>ตามข้อมูลจากระบบ NOAA CFSv2 Operational<sup><a href="">[?]</a></sup></p>
            <table class="table">
                <thead>
                    <tr>
                        <th>ชื่อตัวแปร</th>
                        <th>ระดับความสูง{{--<sup><a href="">[?]</a></sup>--}}</th>
                        <th>เวลา{{--<sup><a href="">[?]</a></sup>--}}</th>
                        <th>ค่าที่ได้</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Geopotential Height</td>
                        <td>200mb</td>
                        <td>00 GMT</td>
                        <td>{{$variable_station['gph200_0']}}</td>
                    </tr>
                    <tr>
                        <td>Geopotential Height</td>
                        <td>850mb</td>
                        <td>00 GMT</td>
                        <td>{{$variable_station['gph850_0']}}</td>
                    </tr>
                    <tr>
                        <td>Relative Humidity</td>
                        <td>200mb</td>
                        <td>00 GMT</td>
                        <td>{{$variable_station['h200_0']}}</td>
                    </tr>
                    <tr>
                        <td>Relative Humidity</td>
                        <td>850mb</td>
                        <td>00 GMT</td>
                        <td>{{$variable_station['h850_0']}}</td>
                    </tr>
                    <tr>
                        <td>Pressure</td>
                        <td>Mean Sea Level</td>
                        <td>00 GMT</td>
                        <td>{{$variable_station['p_msl_0']}}</td>
                    </tr>
                    <tr>
                        <td>Pressure</td>
                        <td>Surface Level</td>
                        <td>00 GMT</td>
                        <td>{{$variable_station['p_sfl_0']}}</td>
                    </tr>
                    <tr>
                        <td>Temperature</td>
                        <td>200 mb</td>
                        <td>00 GMT</td>
                        <td>{{$variable_station['temp200_0']}}</td>
                    </tr>
                    <tr>
                        <td>Temperature</td>
                        <td>850 mb</td>
                        <td>00 GMT</td>
                        <td>{{$variable_station['temp850_0']}}</td>
                    </tr>
                    <tr>
                        <td>U-Component of Wind</td>
                        <td>200 mb</td>
                        <td>00 GMT</td>
                        <td>{{$variable_station['u200_0']}}</td>
                    </tr>
                    <tr>
                        <td>U-Component of Wind</td>
                        <td>850 mb</td>
                        <td>00 GMT</td>
                        <td>{{$variable_station['u850_0']}}</td>
                    </tr>
                    <tr>
                        <td>V-Component of Wind</td>
                        <td>200 mb</td>
                        <td>00 GMT</td>
                        <td>{{$variable_station['v200_0']}}</td>
                    </tr>
                    <tr>
                        <td>V-Component of Wind</td>
                        <td>850 mb</td>
                        <td>00 GMT</td>
                        <td>{{$variable_station['v850_0']}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@stop


@section('script')
<script>
$(document).ready(function(){
    var rainfall = parseInt($('#rainfall').text());
    var droplets = 0;
    var dropletString = ""

    if(rainfall < 0.1) droplets = 0;
    else if(rainfall < 10.0) droplets = 1;
    else if(rainfall < 35.0) droplets = 2;
    else if(rainfall < 90.0) droplets = 3;
    else droplets = 4;

    if(rainfall < 0.1) $('#droplets').attr('title', 'ไม่มีฝน');
    else if(rainfall < 10.0) $('#droplets').attr('title', 'ฝนตกเล็กน้อย');
    else if(rainfall < 35.0) $('#droplets').attr('title', 'ฝนตกปานกลาง');
    else if(rainfall < 90.0) $('#droplets').attr('title', 'ฝนตกหนัก');
    else $('#droplets').attr('title', 'ฝนตกหนักมาก');

    for(var i = 0; i < 4; i++){
        if(i < droplets)
        dropletString += '<span class="glyphicon glyphicon-tint droplet"></span>';
        else
        dropletString += '<span class="glyphicon glyphicon-tint no-droplet"></span>';
    }
    $('#droplets').html(dropletString);
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
});
</script>
@stop
