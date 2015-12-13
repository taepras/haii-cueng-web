@extends('template.master')


@section('page-header')
<h1>ผลการทดสอบ  </h1>
<p>ผลการพยากรณ์ปริมาณฝน ณ สถานีตรวจวัดปริมาณน้ำฝน <a href="{{url().'/forecast'}}" title="เลือกสถานีอื่น"><b>แม่ฮ่องสอน</b></a></p>
@stop


@section('content')
<div class="col-sm-12">
    <form class="form-inline">
        <label>เลือกสถานี&nbsp;&nbsp;</label>
        <select class="form-control">
            <option>--เลือกสถานี--</option>
            <option value="000000">แม่ฮ่องสอน</option>
            <option value="000000">แม่สะเรียง</option>
            <option value="000000">เชียงราย</option>
            <option value="000000">เชียงราย (1)</option>
            <option value="000000">พะเยา</option>
            <option value="000000">แม่โจ้</option>
            <option value="000000">เชียงใหม่</option>
            <option value="000000">ลำปาง</option>
            <option value="000000">ลำปาง (1)</option>
            <option value="000000">ลำพูน</option>
            <option value="000000">แพร่</option>
            <option value="000000">น่าน</option>
            <option value="000000">น่าน (1)</option>
            <option value="000000">ท่าวังผา (2)</option>
            <option value="000000">ทุ่งช้าง (2)</option>
            <option value="000000">อุตรดิตถ์</option>
            <option value="000000">หนองคาย</option>
            <option value="000000">เลย</option>
            <option value="000000">เลย (1)</option>
            <option value="000000">อุดรธานี</option>
            <option value="000000">สกลนคร</option>
            <option value="000000">สกลนคร (1)</option>
            <option value="000000">นครพนม</option>
            <option value="000000">นครพนม (1)</option>
            <option value="000000">หนองบัวลำภู</option>
            <option value="000000">สุโขทัย</option>
            <option value="000000">ศรีสำโรง</option>
            <option value="000000">ตาก</option>
            <option value="000000">แม่สอด</option>
            <option value="000000">เขื่อนภูมิพล</option>
            <option value="000000">ดอยมูเซอ (1)</option>
            <option value="000000">อุ้มผาง</option>
            <option value="000000">พิษณุโลก</option>
            <option value="000000">เพชรบูรณ์</option>
            <option value="000000">หล่มสัก</option>
            <option value="000000">วิเชียรบุรี</option>
            <option value="000000">กำแพงเพชร</option>
            <option value="000000">ขอนแก่น</option>
            <option value="000000">ท่าพระ (1)</option>
            <option value="000000">มุกดาหาร</option>
            <option value="000000">พิจิตร</option>
            <option value="000000">โกสุมพิสัย</option>
            <option value="000000">กมลาไสย (2)</option>
            <option value="000000">นครสวรรค์</option>
            <option value="000000">ตากฟ้า</option>
            <option value="000000">ชัยนาท</option>
            <option value="000000">ชัยภูมิ</option>
            <option value="000000">ร้อยเอ็ด</option>
            <option value="000000">ร้อยเอ็ด (1)</option>
            <option value="000000">อุบลราชธานี (1)</option>
            <option value="000000">อุบลราชธานี</option>
            <option value="000000">ศรีสะเกษ (1)</option>
            <option value="000000">อยุธยา (1)</option>
            <option value="000000">ปทุมธานี (1)</option>
            <option value="000000">ฉะเชิงเทรา (1)</option>
            <option value="000000">ราชบุรี (1)</option>
            <option value="000000">สุพรรณบุรี</option>
            <option value="000000">อู่ทอง (1)</option>
            <option value="000000">ลพบุรี</option>
            <option value="000000">บัวชุม (2)</option>
            <option value="000000">กรมอุตุนิยมวิทยา</option>
            <option value="000000">สุวรรณภูมิ(สนามบิน)</option>
            <option value="000000">ปราจีนบุรี</option>
            <option value="000000">กบินทร์บุรี (2)</option>
            <option value="000000">นครราชสีมา</option>
            <option value="000000">ปากช่อง (1)</option>
            <option value="000000">โชคชัย (2)</option>
            <option value="000000">สุรินทร์</option>
            <option value="000000">สุรินทร์ (1)</option>
            <option value="000000">สอท.ท่าตูม*</option>
            <option value="000000">บุรีรัมย์</option>
            <option value="000000">นางรอง (2)</option>
            <option value="000000">อรัญประเทศ</option>
            <option value="000000">สระแก้ว (2)</option>
            <option value="000000">กาญจนบุรี</option>
            <option value="000000">ทองผาภูมิ</option>
            <option value="000000">กำแพงแสน (1)</option>
            <option value="000000">ศูนย์สิริกิตต์</option>
            <option value="000000">ท่าเรือกรุงเทพฯ</option>
            <option value="000000">บางนา (1)</option>
            <option value="000000">บางเขน</option>
            <option value="000000">สนามบินกรุงเทพฯ</option>
            <option value="000000">ชลบุรี</option>
            <option value="000000">เกาะสีชัง</option>
            <option value="000000">พัทยา</option>
            <option value="000000">สัตหีบ</option>
            <option value="000000">แหลมฉบัง</option>
            <option value="000000">เพชรบุรี</option>
            <option value="000000">ระยอง</option>
            <option value="000000">ห้วยโป่ง (1)</option>
            <option value="000000">จันทบุรี</option>
            <option value="000000">พลิ้ว</option>
            <option value="000000">ประจวบคีรีขันธ์</option>
            <option value="000000">หัวหิน</option>
            <option value="000000">หนองพลับ (1)</option>
            <option value="000000">คลองใหญ่</option>
            <option value="000000">ชุมพร</option>
            <option value="000000">สวี (1)</option>
            <option value="000000">ระนอง</option>
            <option value="000000">สุราษฎร์ธานี</option>
            <option value="000000">สุราษฎร์ธานี</option>
            <option value="000000">เกาะสมุย</option>
            <option value="000000">สุราษฎร์ธานี</option>
            <option value="000000">พระแสง (2)</option>
            <option value="000000">นครศรีธรรมราช</option>
            <option value="000000">ขนอม</option>
            <option value="000000">นครศรีธรรมราช (1)</option>
            <option value="000000">ฉวาง (2)</option>
            <option value="000000">พัทลุง</option>
            <option value="000000">ตะกั่วป่า</option>
            <option value="000000">ภูเก็ต</option>
            <option value="000000">สนามบินภูเก็ต</option>
            <option value="000000">เกาะลันตา</option>
            <option value="000000">กระบี่</option>
            <option value="000000">ตรัง</option>
            <option value="000000">คอหงษ์ (1)</option>
            <option value="000000">สะเดา (2)</option>
            <option value="000000">สงขลา</option>
            <option value="000000">หาดใหญ่</option>
            <option value="000000">สตูล</option>
            <option value="000000">ปัตตานี</option>
            <option value="000000">ยะลา</option>
            <option value="000000">นราธิวาส</option>
        </select>
        &nbsp;&nbsp;
        <button class="btn btn-primary">ดูข้อมูล &raquo;</button>
    </form>
</div>
<div class="col-sm-9">
    <div id="chart"></div>
    <form role="form" class="form-inline">
        <label class="choose-date-label">ปริมาณฝน ตั้งแต่วันที่&nbsp;&nbsp;</label>
        <input type="date" class="form-control">
        <label class="choose-date-label">&nbsp;&nbsp;ถึงวันที่&nbsp;&nbsp;</label>
        <input type="date" class="form-control">
        &nbsp;&nbsp;
        <button type="submit" class="btn btn-default">ดูข้อมูล &raquo;</button>
    </form>
</div>
<div class="col-sm-3 text-center">
    <p>ค่าสถิติของส่วนที่เลือก</p>
    <p>F1 Score</p>
    <h1 class="huge-text">0.78</h1>
    <hr>
    <p>Root Mean Square Error (RMSE)</p>
    <h1 class="huge-text">9.81</h1>
    <p>มิลลิเมตร</p>
    <hr>
    <p>F1 Score เฉลี่ยของ Model <b>0.78</b></p>
    <p>RMSE เฉลี่ยของ Model <b>8.93</b></p>
</div>
@stop


@section('script')
<script>
$(document).ready(function(){
});

var chart = c3.generate({
    data: {
        x: 'date',
        url: '{{url().'/csv/mocktest.csv'}}',
        type: 'line',
        hide: ['']
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
    },
    size: {
        height: 400
    },
});
</script>
@stop
