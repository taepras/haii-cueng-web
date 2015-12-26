@extends('template.master')


@section('page-header')
<h1>ผลการทดสอบ  </h1>
<p>ผลการทดสอบการพยากรณ์ปริมาณฝน ณ สถานีตรวจวัดปริมาณน้ำฝน <b>{{$info_station['station_name']}}</b></p>
@stop


@section('content')
<div class="col-sm-8 col-sm-offset-2">
    <form class="form-horizontal text-left" method="post" action="{{url().'/test_results'}}">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-3">เลือกสถานี</label>
            <div class="col-sm-9">
                <select class="form-control" id="station" name="id">
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
    <h1 class="huge-text">{{round($f1_score*100,2)}}%</h1>
    <hr>
    <p>Root Mean Square Error (RMSE)</p>
    <h1 class="huge-text">{{round($rmse, 2)}}</h1>
    <p>มิลลิเมตร</p>
    <hr>
    <p>F1 Score เฉลี่ยของ Model <b>0.78</b></p>
    <p>RMSE เฉลี่ยของ Model <b></b></p>

    {{-- $variable_station[index][field] --}}
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
});

var chart = c3.generate({
    data: {
        x: 'date',
        url: '{{url().'/csv/mocktest.csv'}}',
        type: 'line',
        hide: ['', 'error']
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
