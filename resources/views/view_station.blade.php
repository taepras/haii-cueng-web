@extends('template.master')


@section('page-header')
<h1>ผลการพยากรณ์</h1>
<p>ผลการพยากรณ์ล่วงหน้า 9 เดือน ณ สถานีตรวจวัดปริมาณน้ำฝน <a href="{{url().'/forecast'}}" title="เลือกสถานีอื่น"><b>แม่ฮ่องสอน</b></a></p>
@stop


@section('content')
<form role="form">
    <div class="col-sm-12">
        <div class="form-inline">
            <label class="choose-date-label">ปริมาณฝน ตั้งแต่วันที่&nbsp;&nbsp;</label>
            <input type="date" class="form-control" id="start_date">
            <label class="choose-date-label">&nbsp;&nbsp;ถึงวันที่&nbsp;&nbsp;</label>
            <input type="date" class="form-control" id="end_date">
            &nbsp;&nbsp;
            <button type="submit" class="btn btn-primary">ดูข้อมูล &raquo;</button>
        </div>
        <br>
        <div id="chart"></div>
        <br><br>
    </div>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-5">
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
                        <tr>
                            <th>ข้อมูลตั้งแต่วันที่</th>
                            {{-- <td>{{date("d/m/Y", strtotime($start_date))}}</td> --}}
                        </tr>
                        <tr>
                            <th>ข้อมูลถึงวันที่</th>
                            {{-- <td>{{date("d/m/Y", strtotime($end_date))}}</td> --}}
                        </tr>
                        <!-- <b>ตำบล</b> ห้วยผา<br>
                        <b>อำเภอ</b> เมืองแม่ฮ่องสอน<br>
                        <b>จังหวัด</b> แม่ฮ่องสอน -->
                    </table>
                </div>
                <a href="{{url().'/forecast'}}" class="btn btn-default">&laquo; เลือกสถานีอื่น</a>
            </div>
            <div class="col-sm-7 text-left">
                <h3>เลือกดูตัวแปรที่ใช้ทำนาย</h3>
                <p>ตามข้อมูลจากระบบ NOAA CFSv2 Operational<sup><a href="">[?]</a></sup></p>
                <form role="form">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ตัวแปร</th>
                                <th colspan="8">แสดงในกราฟ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ปริมาณฝน</td>
                                <td colspan="8"><input type="checkbox" value="rainfall" checked></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ระดับความสูง</th>
                                <th colspan="4">200mb</th>
                                <th colspan="4">850mb</th>
                            </tr>
                            <tr>
                                <th>เวลา</th>
                                <th>00</th>
                                <th>06</th>
                                <th>12</th>
                                <th>18</th>
                                <th>00</th>
                                <th>06</th>
                                <th>12</th>
                                <th>18</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Geopotential Height</td>
                                <td><input type="checkbox" value="t00.gph.200"></td>
                                <td><input type="checkbox" value="t06.gph.200"></td>
                                <td><input type="checkbox" value="t12.gph.200"></td>
                                <td><input type="checkbox" value="t18.gph.200"></td>
                                <td><input type="checkbox" value="t00.gph.850"></td>
                                <td><input type="checkbox" value="t06.gph.850"></td>
                                <td><input type="checkbox" value="t12.gph.850"></td>
                                <td><input type="checkbox" value="t18.gph.850"></td>
                            </tr>
                            <tr>
                                <td>Relative Humidity</td>
                                <td><input type="checkbox" value="t00.humidity.200"></td>
                                <td><input type="checkbox" value="t06.humidity.200"></td>
                                <td><input type="checkbox" value="t12.humidity.200"></td>
                                <td><input type="checkbox" value="t18.humidity.200"></td>
                                <td><input type="checkbox" value="t00.humidity.850"></td>
                                <td><input type="checkbox" value="t06.humidity.850"></td>
                                <td><input type="checkbox" value="t12.humidity.850"></td>
                                <td><input type="checkbox" value="t18.humidity.850"></td>
                            </tr>
                            <tr>
                                <td>Temperature</td>
                                <td><input type="checkbox" value="t00.temp.200"></td>
                                <td><input type="checkbox" value="t06.temp.200"></td>
                                <td><input type="checkbox" value="t12.temp.200"></td>
                                <td><input type="checkbox" value="t18.temp.200"></td>
                                <td><input type="checkbox" value="t00.temp.850"></td>
                                <td><input type="checkbox" value="t06.temp.850"></td>
                                <td><input type="checkbox" value="t12.temp.850"></td>
                                <td><input type="checkbox" value="t18.temp.850"></td>
                            </tr>
                            <tr>
                                <td>U-Component of Wind</td>
                                <td><input type="checkbox" value="t00.uwind.200"></td>
                                <td><input type="checkbox" value="t06.uwind.200"></td>
                                <td><input type="checkbox" value="t12.uwind.200"></td>
                                <td><input type="checkbox" value="t18.uwind.200"></td>
                                <td><input type="checkbox" value="t00.uwind.850"></td>
                                <td><input type="checkbox" value="t06.uwind.850"></td>
                                <td><input type="checkbox" value="t12.uwind.850"></td>
                                <td><input type="checkbox" value="t18.uwind.850"></td>
                            </tr>
                            <tr>
                                <td>V-Component of Wind</td>
                                <td><input type="checkbox" value="t00.vwind.200"></td>
                                <td><input type="checkbox" value="t06.vwind.200"></td>
                                <td><input type="checkbox" value="t12.vwind.200"></td>
                                <td><input type="checkbox" value="t18.vwind.200"></td>
                                <td><input type="checkbox" value="t00.vwind.850"></td>
                                <td><input type="checkbox" value="t06.vwind.850"></td>
                                <td><input type="checkbox" value="t12.vwind.850"></td>
                                <td><input type="checkbox" value="t18.vwind.850"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ระดับความสูง</th>
                                <th colspan="4">Mean Sea Level</th>
                                <th colspan="4">Surface Level</th>
                            </tr>
                            <tr>
                                <th>เวลา</th>
                                <th>00</th>
                                <th>06</th>
                                <th>12</th>
                                <th>18</th>
                                <th>00</th>
                                <th>06</th>
                                <th>12</th>
                                <th>18</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Pressure</td>
                                <td><input type="checkbox" value="t00.pressure.meansea"></td>
                                <td><input type="checkbox" value="t06.pressure.meansea"></td>
                                <td><input type="checkbox" value="t12.pressure.meansea"></td>
                                <td><input type="checkbox" value="t18.pressure.meansea"></td>
                                <td><input type="checkbox" value="t00.pressure.surface"></td>
                                <td><input type="checkbox" value="t06.pressure.surface"></td>
                                <td><input type="checkbox" value="t12.pressure.surface"></td>
                                <td><input type="checkbox" value="t18.pressure.surface"></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary btn-block">ดูกราฟของตัวแปรที่เลือก &raquo;</button>
                </div>
            </div>
        </div>
    </div>
</form>
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
});

var chart = c3.generate({
    data: {
        x: 'date',
        // json: {!! json_encode($b) !!},
        url: '{{url().'/test/300201_edited_s.csv'}}',
        type: 'line',
        // keys: {
        //     x: 'date', // it's possible to specify 'x' when category axis
        //     value: ['gph200_0', 'gph850_0'],
        // }
        // show: ['value']
        hide: ['mintemp', 'maxtemp']
    },
    axis: {
        x: {
            type: 'timeseries',
            tick: {
                format: '%Y-%m-%d'
            }
        },
        y: {
            label: 'rainfall(mm)',
            position: 'outer-center'
        }
    },
    zoom: {
        enabled: true
    }
});
</script>
@stop
