@extends('template.master')


@section('page-header')
<h1>ผลการพยากรณ์</h1>
<form role="form" class="form-inline">
    <label class="choose-date-label">เลือกดูปริมาณฝน ณ วันที่&nbsp;&nbsp;</label>
    <input type="date" class="form-control">
    &nbsp;&nbsp;
    <button type="submit" class="btn btn-default">ดูข้อมูล &raquo;</button>
</form>
@stop


@section('content')
<div class="col-sm-5">
    <h4><b>คลิกบนจุดข้อมูลในแผนที่เพื่อเลือกสถานีที่ต้องการ</b></h4>
    <div id="chart"></div>
</div>
<div class="col-sm-7">
    <div class="row">
        <div class="col-sm-6">
            <p>สถานีตรวจวัดปริมาณฝน</p>
            <h3 class="station-name"><b>แม่ฮ่องสอน</b></h3>
            <div>
                <table class="table text-left">
                    <tr>
                        <th>ตำบล</th>
                        <td>ห้วยผา</td>
                    </tr>
                    <tr>
                        <th>อำเภอ</th>
                        <td>เมืองแม่ฮ่องสอน</td>
                    </tr>
                    <tr>
                        <th>จังหวัด</th>
                        <td>แม่ฮ่องสอน</td>
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
                ปริมาณฝน ณ วันที่ xx-xx-xx
            </p>
            <h1 class="huge-text" id="rainfall">52.7</h1>
            <p>
                มิลลิเมตร<sup><a href="">[?]</a></sup>
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
                        <th>ระดับความสูง<sup><a href="">[?]</a></sup></th>
                        <th>เวลา<sup><a href="">[?]</a></sup></th>
                        <th>ค่าที่ได้</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Geopotential Height</td>
                        <td>200mb</td>
                        <td>00 GMT</td>
                        <td>xxxxx</td>
                    </tr>
                    <tr>
                        <td>Geopotential Height</td>
                        <td>850mb</td>
                        <td>00 GMT</td>
                        <td>xxxxx</td>
                    </tr>
                    <tr>
                        <td>Relative Humidity</td>
                        <td>200mb</td>
                        <td>00 GMT</td>
                        <td>xxxxx</td>
                    </tr>
                    <tr>
                        <td>Relative Humidity</td>
                        <td>850mb</td>
                        <td>00 GMT</td>
                        <td>xxxxx</td>
                    </tr>
                    <tr>
                        <td>Pressure</td>
                        <td>Mean Sea Level</td>
                        <td>00 GMT</td>
                        <td>xxxxx</td>
                    </tr>
                    <tr>
                        <td>Pressure</td>
                        <td>Surface Level</td>
                        <td>00 GMT</td>
                        <td>xxxxx</td>
                    </tr>
                    <tr>
                        <td>Temperature</td>
                        <td>200 mb</td>
                        <td>00 GMT</td>
                        <td>xxxxx</td>
                    </tr>
                    <tr>
                        <td>Temperature</td>
                        <td>850 mb</td>
                        <td>00 GMT</td>
                        <td>xxxxx</td>
                    </tr>
                    <tr>
                        <td>U-Component of Wind</td>
                        <td>200 mb</td>
                        <td>00 GMT</td>
                        <td>xxxxx</td>
                    </tr>
                    <tr>
                        <td>U-Component of Wind</td>
                        <td>850 mb</td>
                        <td>00 GMT</td>
                        <td>xxxxx</td>
                    </tr>
                    <tr>
                        <td>V-Component of Wind</td>
                        <td>200 mb</td>
                        <td>00 GMT</td>
                        <td>xxxxx</td>
                    </tr>
                    <tr>
                        <td>V-Component of Wind</td>
                        <td>850 mb</td>
                        <td>00 GMT</td>
                        <td>xxxxx</td>
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

// var chart = c3.generate({
//     data: {
//         x: 'long',
//         ys: {
//             lat: 'lat',
//             name_e: 'name_e'
//         },
//         url: '{{url().'/csv/stations.csv'}}',
//         hide: ['code', 'name_e', 'name_th'],
//         type: 'scatter'
//     },
//     color: 'blue',
//     point: {
//         r: function(d) {
//             //console.log(chart.data('name_e'));
//             return d.value;
//         }
//     },
//     axis: {
//         x: {
//             label: 'longitude',
//             position: 'outer-center',
//             tick: {count: 3}
//         },
//         y: {
//             label: 'latitude',
//             position: 'outer-center'
//         }
//     },
//     size: {
//         height: 700,
//         width: 360
//     },
//     tooltip: {
//         format: {
//             title: function (d) {
//                 console.log();
//                 return 'Data ' + d;
//             },
//             contents: function(d){
//                 console.log(d);
//                 return d;
//             }
//             // value: function (value, ratio, id) {
//             //     var format = id === 'data1' ? d3.format(',') : d3.format('$');
//             //     return format(value);
//             // }
//         }
//     },
// });


//------------------------------------------------------------------------------------------------

d3.csv("{{url().'/csv/stations.csv'}}", function(csv) {
    // csv = csv.filter(function(key) {
    //     return key != "Sex" && key != "L" && key != "M" && key != "S" ;
    // });
    console.log(csv);
    var chart = c3.generate({
        data: {
            json: csv,
            keys: {
                x: 'long',
                value: ['lat', 'name_e', 'code'],
            },
            type: 'scatter',
            onclick: function(d){
                console.log(d);
            }
        },
        color: 'blue',
        point: {
            r: function(d) {
                // console.log(csv[d.index]);
                // console.log(this.data_json[d.index]);
                return (csv[d.index].long-96)*2;
            }
        },
        axis: {
            x: {
                label: 'longitude',
                position: 'outer-center',
                tick: {count: 3}
            },
            y: {
                label: 'latitude',
                position: 'outer-center'
            }
        },
        size: {
            height: 700,
            width: 360
        },
        tooltip: {
            format: {
                name: function (name, ratio, id, index) {
                    console.log(name);
                    console.log(ratio);
                    console.log(id);
                    console.log(index);
                    console.log(csv[index]);
                    return 'Data ' + name;
                },
                contents: function(d){
                    console.log(d);
                    return d;
                }
                // value: function (value, ratio, id) {
                //     var format = id === 'data1' ? d3.format(',') : d3.format('$');
                //     return format(value);
                // }
            }
        }
    });
});

</script>
@stop
