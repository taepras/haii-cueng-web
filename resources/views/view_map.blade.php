@extends('template.master')


@section('page-header')
<h1>ผลการพยากรณ์</h1>
<p>ผลการพยากรณ์ปริมาณฝน ณ วันที่ {{date("d/m/Y", strtotime($date))}} </a></p>
@stop


@section('content')
<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <form role="form" class="form-inline" method="post" action="{{url().'/forecast'}}">
                {!! csrf_field() !!}
                <label class="choose-date-label">เลือกดูปริมาณฝน ณ สถานี&nbsp;&nbsp;</label>
                <select class="form-control" id="station" name = 'id'>
                    <option>--เลือกสถานี--</option>
                    <option value="376202">MAE SOT แม่สอด</option>
                    <option value="376301">DOI MUSOE ดอยมูเซอ (1)</option>
                    <option value="300202">MAE SARIANG แม่สะเรียง</option>
                    <option value="300201">MAE HONG SON แม่ฮ่องสอน</option>
                    <option value="383201">MUKDAHAN มุกดาหาร</option>
                    <option value="356301">SAKON NAKHON สกลนคร (1)</option>
                    <option value="356201">SAKON NAKHON สกลนคร</option>
                    <option value="357301">NAKHON PHANOM นครพนม (1)</option>
                    <option value="354201">UDON THANI อุดรธานี</option>
                    <option value="353301">LOEI เลย (1)</option>
                    <option value="357201">NAKHON PHANOM นครพนม</option>
                    <option value="353201">LOEI เลย</option>
                    <option value="352201">NONG KHAI หนองคาย</option>
                    <option value="310201">PHAYAO พะเยา</option>
                    <option value="303301">CHIANG RAI เชียงราย (1)</option>
                    <option value="327202">Doi Ang Khang ดอยอ่างขาง</option>
                    <option value="303201">CHIANG RAI เชียงราย</option>
                    <option value="403201">CHAIYAPHUM ชัยภูมิ</option>
                    <option value="405201">ROI ET ร้อยเอ็ด</option>
                    <option value="405301">ROI ET ร้อยเอ็ด (1)</option>
                    <option value="387401">KOSUM PHISAI โกสุมพิสัย</option>
                    <option value="388401">KAMALASAI กมลาไสย (2)</option>
                    <option value="381301">THA PHRA ท่าพระ (1)</option>
                    <option value="381201">KHON KAEN ขอนแก่น</option>
                    <option value="360201">Nongbualamphu หนองบัวลำภู</option>
                    <option value="436401">NANG RONG นางรอง (2)</option>
                    <option value="431401">CHOK CHAI โชคชัย (2)</option>
                    <option value="432201">SURIN สุรินทร์</option>
                    <option value="432301">SURIN สุรินทร์ (1)</option>
                    <option value="431201">NAKHON RATCHASIMA นครราชสีมา</option>
                    <option value="409301">SI SA KET ศรีสะเกษ (1)</option>
                    <option value="436201">Buri Ram บุรีรัมย์</option>
                    <option value="407301">UBON RATCHATHANI อุบลราชธานี (1)</option>
                    <option value="407501">UBON RATCHATHANI อุบลราชธานี</option>
                    <option value="432401">THA TUM สอท.ท่าตูม*</option>
                    <option value="380201">KAMPHAENG PHET กำแพงเพชร</option>
                    <option value="376201">TAK ตาก</option>
                    <option value="376203">BHUMIBOL DAM เขื่อนภูมิพล</option>
                    <option value="329201">LAMPHUN ลำพูน</option>
                    <option value="327501">CHIANG MAI เชียงใหม่</option>
                    <option value="327301">MAE CHO แม่โจ้</option>
                    <option value="328202">Thoen เถิน</option>
                    <option value="328201">LAMPANG ลำปาง</option>
                    <option value="328301">LAMPANG ลำปาง (1)</option>
                    <option value="386301">PICHIT พิจิตร</option>
                    <option value="373201">Sukhothai สุโขทัย</option>
                    <option value="373301">SI SAMRONG ศรีสำโรง</option>
                    <option value="330201">PHRAE แพร่</option>
                    <option value="378201">PHITSANULOK พิษณุโลก</option>
                    <option value="351201">UTTARADIT อุตรดิตถ์</option>
                    <option value="331201">NAN น่าน</option>
                    <option value="331301">NAN น่าน (1)</option>
                    <option value="331401">THA WANGPHA ท่าวังผา (2)</option>
                    <option value="331402">Tung Chang ทุ่งช้าง (2)</option>
                    <option value="429201">PILOT STATION กรมอุตุนิยมวิทยา</option>
                    <option value="455301">BANG NA บางนา (1)</option>
                    <option value="455203">(KLONG TOEY) ท่าเรือกรุงเทพฯ</option>
                    <option value="455201">BANGKOK METROPOLI ศูนย์สิริกิตต์</option>
                    <option value="455302">BANG KHEN บางเขน</option>
                    <option value="455601">DON MUANG AIRPORT สนามบินกรุงเทพฯ</option>
                    <option value="419301">Phathum Thani ปทุมธานี (1)</option>
                    <option value="426201">LOP BURI ลพบุรี</option>
                    <option value="402301">CHAI NAT ชัยนาท</option>
                    <option value="400301">TAK FA ตากฟ้า</option>
                    <option value="400201">NAKHON SAWAN นครสวรรค์</option>
                    <option value="415301">AYUTTAYA อยุธยา (1)</option>
                    <option value="431301">PAK CHONG ปากช่อง (1)</option>
                    <option value="426401">BUA CHUM บัวชุม (2)</option>
                    <option value="379402">WICHIAN BURI วิเชียรบุรี</option>
                    <option value="379201">PHETCHABUN เพชรบูรณ์</option>
                    <option value="379401">LOM SAK หล่มสัก</option>
                    <option value="451301">KAMPHAENG SAEN กำแพงแสน (1)</option>
                    <option value="425301">U THONG อู่ทอง (1)</option>
                    <option value="425201">SUPHAN BURI สุพรรณบุรี</option>
                    <option value="424301">RATCHABURI ราชบุรี (1)</option>
                    <option value="450201">KANCHANA BURI กาญจนบุรี</option>
                    <option value="450401">THONG PHAPHUM ทองผาภูมิ</option>
                    <option value="376401">UMPHANG อุ้มผาง</option>
                    <option value="440401">SA KAEW สระแก้ว (2)</option>
                    <option value="430401">KABIN BURI กบินทร์บุรี (2)</option>
                    <option value="430201">PRACHIN BURI ปราจีนบุรี</option>
                    <option value="429301">Samutprakan Agromet สมุทรปราการ (บางปลา)</option>
                    <option value="423301">CHACHOENGSAO ฉะเชิงเทรา (1)</option>
                    <option value="429601">Suvarnabhumi Intl. Airport สุวรรณภูมิ(สนามบิน)</option>
                    <option value="440201">ARANYA PRATHET อรัญประเทศ</option>
                    <option value="501201">KHLONG YAI คลองใหญ่</option>
                    <option value="480301">PHLIU พลิ้ว</option>
                    <option value="480201">CHANTHA BURI จันทบุรี</option>
                    <option value="478201">RAYONG ระยอง</option>
                    <option value="459204">SATTAHIP สัตหีบ</option>
                    <option value="478301">HUAI PONG ห้วยโป่ง (1)</option>
                    <option value="459203">PHATTHAYA พัทยา</option>
                    <option value="459205">LAEM CHABANG แหลมฉบัง</option>
                    <option value="459202">KO SICHANG เกาะสีชัง</option>
                    <option value="459201">CHON BURI ชลบุรี</option>
                    <option value="500202">HUA HIN หัวหิน</option>
                    <option value="465201">PHETCHA BURI เพชรบุรี</option>
                    <option value="500201">PRACHUAP KHIRIKHAN ประจวบคีรีขันธ์</option>
                    <option value="500301">NONG PHLUB หนองพลับ (1)</option>
                    <option value="583201">NARATHIWAT นราธิวาส</option>
                    <option value="580201">PATTANI AIRPORT ปัตตานี</option>
                    <option value="552301">NAKHON SI THAMMARAT นครศรีธรรมราช (1)</option>
                    <option value="552201">NAKHONSI THAMMARAT นครศรีธรรมราช</option>
                    <option value="551301">SURAT THANI สุราษฎร์ธานี</option>
                    <option value="551203">KO SAMUI เกาะสมุย</option>
                    <option value="517301">SAWI สวี (1)</option>
                    <option value="517201">CHUMPHON ชุมพร</option>
                    <option value="552401">Chawang ฉวาง (2)</option>
                    <option value="551401">Prasaeng พระแสง (2)</option>
                    <option value="552202">KHANOM ขนอม</option>
                    <option value="551201">SURAT THANI สุราษฎร์ธานี</option>
                    <option value="551202">SURAT THANI AIR สุราษฎร์ธานี</option>
                    <option value="568401">Sa Dao สะเดา (2)</option>
                    <option value="568502">HAT YAI AIRPORT หาดใหญ่</option>
                    <option value="568301">KHO HONG คอหงษ์ (1)</option>
                    <option value="568501">SONGKHLA สงขลา</option>
                    <option value="560301">PHATTALUNG พัทลุง</option>
                    <option value="581301">YALA ยะลา</option>
                    <option value="570201">SATUN สตูล</option>
                    <option value="567201">TRANG AIRPORT ตรัง</option>
                    <option value="566201">KO LANTA เกาะลันตา</option>
                    <option value="564201">PHUKET ภูเก็ต</option>
                    <option value="566202">KRABI กระบี่</option>
                    <option value="564202">PHUKET AIRPORT สนามบินภูเก็ต</option>
                    <option value="561201">TAKUA PA ตะกั่วป่า</option>
                    <option value="532201">RANONG ระนอง</option>
                </select>
                <label class="choose-date-label">&nbsp;&nbsp;วันที่&nbsp;&nbsp;</label>
                <input type="date" class="form-control" name="date" id="date">
                &nbsp;&nbsp;
                <button type="submit" class="btn btn-primary">ดูข้อมูล &raquo;</button>
            </form>
        </div>
    </div>
    <hr>
</div>
<div class="col-sm-5">
    <h4><b>ผลการพยากรณ์ปริมาณฝนทั่วประเทศ<br>ณ วันที่ {{date("d/m/Y", strtotime($date))}}</b></h4>
    <div id="chart"></div>
</div>
<div class="col-sm-7">

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
                ปริมาณฝน ณ วันที่ {{date("d/m/Y", strtotime($date))}}
            </p>
            <h1 class="huge-text" id="rainfall">{{ round($variable_station['predict_rainfall'], 1) }}</h1>
            <p>
                มิลลิเมตร{{--<sup><a href="">[?]</a></sup>--}}
                <span id="droplets"></span>
            </p>
            @if(isset($variable_station['actual_rainfall']))
                <p>
                    <b>ปริมาณฝนจริง</b> {{round($variable_station['actual_rainfall'], 2)}} มิลลิเมตร
                    <br><b>ทำนายคลาดเคลื่อน</b> <span class="text-danger">{{round(abs($variable_station['actual_rainfall'] - $variable_station['predict_rainfall']), 2)}}</span> มิลลิเมตร
                </p>
            @endif
            <a href="{{url().'/forecast/'.$station_id}}" class="btn btn-success btn-block">
                ดูผลการพยากรณ์ของสถานีนี้ &raquo;
            </a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12 text-left">
            <div>
                <div class="pull-right txt-right">
                    <label>เลือกเวลา</label>
                    <select class="form-control" id="choose-time">
                        <option value="00">00 GMT</option>
                        <option value="06">06 GMT</option>
                        <option value="12">12 GMT</option>
                        <option value="18">18 GMT</option>
                    </select>
                </div>
                <h3>ค่าของตัวแปรที่ใช้ทำนาย</h3>
                <p>ตามข้อมูลจากระบบ NOAA CFSv2 Operational<sup><a href="">[?]</a></sup></p>
            </div>
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
                        <td class="time">00 GMT</td>
                        <td id="gph-200" class="t00">{{ round($variable_station['gph200_0'], 2) }} m</td>
                        <td id="gph-200" class="t06">{{ round($variable_station['gph200_6'], 2) }} m</td>
                        <td id="gph-200" class="t12">{{ round($variable_station['gph200_12'], 2) }} m</td>
                        <td id="gph-200" class="t18">{{ round($variable_station['gph200_18'], 2) }} m</td>
                    </tr>
                    <tr>
                        <td>Geopotential Height</td>
                        <td>850mb</td>
                        <td class="time">00 GMT</td>
                        <td id="gph-850" class="t00">{{ round($variable_station['gph850_0'], 2) }} m</td>
                        <td id="gph-850" class="t06">{{ round($variable_station['gph850_6'], 2) }} m</td>
                        <td id="gph-850" class="t12">{{ round($variable_station['gph850_12'], 2) }} m</td>
                        <td id="gph-850" class="t18">{{ round($variable_station['gph850_18'], 2) }} m</td>
                    </tr>
                    <tr>
                        <td>Relative Humidity</td>
                        <td>200mb</td>
                        <td class="time">00 GMT</td>
                        <td id="humidity-200" class="t00">{{ round($variable_station['h200_0'], 2) }}%</td>
                        <td id="humidity-200" class="t06">{{ round($variable_station['h200_6'], 2) }}%</td>
                        <td id="humidity-200" class="t12">{{ round($variable_station['h200_12'], 2) }}%</td>
                        <td id="humidity-200" class="t18">{{ round($variable_station['h200_18'], 2) }}%</td>
                    </tr>
                    <tr>
                        <td>Relative Humidity</td>
                        <td>850mb</td>
                        <td class="time">00 GMT</td>
                        <td id="humidity-850" class="t00">{{ round($variable_station['h850_0'], 2) }}%</td>
                        <td id="humidity-850" class="t06">{{ round($variable_station['h850_6'], 2) }}%</td>
                        <td id="humidity-850" class="t12">{{ round($variable_station['h850_12'], 2) }}%</td>
                        <td id="humidity-850" class="t18">{{ round($variable_station['h850_18'], 2) }}%</td>
                    </tr>
                    <tr>
                        <td>Pressure</td>
                        <td>Mean Sea Level</td>
                        <td class="time">00 GMT</td>
                        <td id="pressure-meansea" class="t00">{{ round($variable_station['p_msl_0'], 2) }} Pa</td>
                        <td id="pressure-meansea" class="t06">{{ round($variable_station['p_msl_6'], 2) }} Pa</td>
                        <td id="pressure-meansea" class="t12">{{ round($variable_station['p_msl_12'], 2) }} Pa</td>
                        <td id="pressure-meansea" class="t18">{{ round($variable_station['p_msl_18'], 2) }} Pa</td>
                    </tr>
                    <tr>
                        <td>Pressure</td>
                        <td>Surface Level</td>
                        <td class="time">00 GMT</td>
                        <td id="pressure-surface" class="t00">{{ round($variable_station['p_sfl_0'], 2) }} Pa</td>
                        <td id="pressure-surface" class="t06">{{ round($variable_station['p_sfl_6'], 2) }} Pa</td>
                        <td id="pressure-surface" class="t12">{{ round($variable_station['p_sfl_12'], 2) }} Pa</td>
                        <td id="pressure-surface" class="t18">{{ round($variable_station['p_sfl_18'], 2) }} Pa</td>
                    </tr>
                    <tr>
                        <td>Temperature</td>
                        <td>200 mb</td>
                        <td class="time">00 GMT</td>
                        <td id="temp-200" class="t00">{{ round($variable_station['temp200_0'], 2) }} K</td>
                        <td id="temp-200" class="t06">{{ round($variable_station['temp200_6'], 2) }} K</td>
                        <td id="temp-200" class="t12">{{ round($variable_station['temp200_12'], 2) }} K</td>
                        <td id="temp-200" class="t18">{{ round($variable_station['temp200_18'], 2) }} K</td>
                    </tr>
                    <tr>
                        <td>Temperature</td>
                        <td>850 mb</td>
                        <td class="time">00 GMT</td>
                        <td id="temp-850" class="t00">{{ round($variable_station['temp850_0'], 2) }} K</td>
                        <td id="temp-850" class="t06">{{ round($variable_station['temp850_6'], 2) }} K</td>
                        <td id="temp-850" class="t12">{{ round($variable_station['temp850_12'], 2) }} K</td>
                        <td id="temp-850" class="t18">{{ round($variable_station['temp850_18'], 2) }} K</td>
                    </tr>
                    <tr>
                        <td>U-Component of Wind</td>
                        <td>200 mb</td>
                        <td class="time">00 GMT</td>
                        <td id="uwind-200" class="t00">{{ round($variable_station['u200_0'], 2) }} m/s</td>
                        <td id="uwind-200" class="t06">{{ round($variable_station['u200_6'], 2) }} m/s</td>
                        <td id="uwind-200" class="t12">{{ round($variable_station['u200_12'], 2) }} m/s</td>
                        <td id="uwind-200" class="t18">{{ round($variable_station['u200_18'], 2) }} m/s</td>
                    </tr>
                    <tr>
                        <td>U-Component of Wind</td>
                        <td>850 mb</td>
                        <td class="time">00 GMT</td>
                        <td id="uwind-850" class="t00">{{ round($variable_station['u850_0'], 2) }} m/s</td>
                        <td id="uwind-850" class="t06">{{ round($variable_station['u850_6'], 2) }} m/s</td>
                        <td id="uwind-850" class="t12">{{ round($variable_station['u850_12'], 2) }} m/s</td>
                        <td id="uwind-850" class="t18">{{ round($variable_station['u850_18'], 2) }} m/s</td>
                    </tr>
                    <tr>
                        <td>V-Component of Wind</td>
                        <td>200 mb</td>
                        <td class="time">00 GMT</td>
                        <td id="vwind-200" class="t00">{{ round($variable_station['v200_0'], 2) }} m/s</td>
                        <td id="vwind-200" class="t06">{{ round($variable_station['v200_6'], 2) }} m/s</td>
                        <td id="vwind-200" class="t12">{{ round($variable_station['v200_12'], 2) }} m/s</td>
                        <td id="vwind-200" class="t18">{{ round($variable_station['v200_18'], 2) }} m/s</td>
                    </tr>
                    <tr>
                        <td>V-Component of Wind</td>
                        <td>850 mb</td>
                        <td class="time">00 GMT</td>
                        <td id="vwind-850" class="t00">{{ round($variable_station['v850_0'], 2) }} m/s</td>
                        <td id="vwind-850" class="t06">{{ round($variable_station['v850_6'], 2) }} m/s</td>
                        <td id="vwind-850" class="t12">{{ round($variable_station['v850_12'], 2) }} m/s</td>
                        <td id="vwind-850" class="t18">{{ round($variable_station['v850_18'], 2) }} m/s</td>
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
    @if(isset($station_id))
        $('#station').val("{{$station_id}}");
    @endif
    @if(isset($date))
        $('#date').val("{{$date}}");
    @endif

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

    $('.t06, .t12, .t18').hide();
    $('#choose-time').change(function(){
        var time =  $(this).val();
        $('.time').text(time + ' GMT');
        $('.t00, .t06, .t12, .t18').hide(0, function(){
            $('.t' + time).show();
        });
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
