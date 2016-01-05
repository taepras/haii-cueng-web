@extends('template.master')


@section('page-header')
<h1>รายละเอียดวิธีการพยากรณ์</h1>
@stop


@section('divider')
{{-- <hr> --}}
@stop


@section('content')
<div class="col-sm-8 col-sm-offset-2 text-left">
	<p class="content">
		ท่านสามารถดาวน์โหลดไฟล์ pdf ของ presentation สำหรับโครงการนี้ได้
		<a href="{{url().'/files/haii_cueng_presentation.pdf'}}">
			ที่นี่ &raquo;
		</a>
	</p>
	<hr>
	<p class="content">
        โครงการนี้เป็นการทำนายปริมาณฝนรายวันของประเทศไทย
		โดยใช้ข้อมูลตัวแปรทางอุตุนิยมวิทยา CFSv2 จากสถาบัน NOAA
		และข้อมูลปริมาณฝนย้อนหลังรายวันจากสถานีตรวจวัดปริมาณฝนจุดต่างๆ ในประเทศจากกรมอุตุนิยมวิทยา
    </p>
	<h2>ข้อมูล</h2>
	<h4><b>CFSv2</b></h4>
    <p class="content">
		ข้อมูล NCEP Climate Forecast System Model Version 2 (CFSv2)
		เป็นข้อมูลจากหน่วยงาน National Centers of Environmental Prediction (NCEP) ของสถาบัน
		National Oceanic and Atmospheric Administration (NOAA) ของประเทศสหรัฐอเมริกา ซึ่งจะเก็บข้อมูลตัวแปรทางอุตุนิยมวิทยาต่างๆ
		ณ ทุกๆ 0.5 องศา ละติจูด และลองจิจูดของโลก ณ ระดับความสูงต่างๆ ทุกๆ 6 ชั่วโมง คือ ณ เวลา 0, 6, 12 และ 18 นาฬิกา (GMT)
	</p>
	<p class="content">
		ตัวแปรจาก CFSv2 ที่เลือกมาใช้ในการทำนายครั้งนี้ได้แก่
		<ul>
			<li><code>Geopotential Height</code> ที่ระดับความสูง 200mb และ 850mb</li>
			<li><code>Relative Humidity</code> ที่ระดับความสูง 200mb และ 850mb</li>
			<li><code>Pressure</code> ที่ระดับความสูง mean sea level และ surface level</li>
			<li><code>Temperature</code> ที่ระดับความสูง 200mb และ 850mb</li>
			<li><code>U/V-Component of Wind</code> ที่ระดับความสูง 200mb และ 850mb</li>
		</ul>
	</p>
	<p class="content">
		ศึกษาข้อมูลเพิ่มเติมได้ที่นี่ <a href="http://cfs.ncep.noaa.gov/">http://cfs.ncep.noaa.gov</a>
    </p>
	<h4><b>ข้อมูลปริมาณฝนรายวัน</b></h4>
	<p class="content">
		ใช้ข้อมูลปริมาณฝนรายวันที่กรมอุตุนิยมวิทยาได้บันทึกไว้ทั้งหมดประมาณ 30 ปี ณ สถานีตรวจวัดปริมาณน้ำฝนจุดต่างๆ
		ทั้งหมด 124 สถานี ทั่วประเทศ มาเป็นข้อมูลสำหรับการสร้างและทดสอบ model เพื่อใช้ในการทำนายในครั้งนี้
	</p>
	<h2>วิธีการทำนาย</h2>
	<p class="content">
		เนี่องจากในข้อมูลที่มี ปริมาณน้ำฝนส่วนใหญ่จะเท่ากับ 0 มิลลิเมตร คือไม่มีฝนตกในวันนั้น คิดเป็นประมาณ 70% ของข้อมูลทั้งหมดจึงเลือกใช้
		2-Stage Model ในการทำนาย โดยแบ่งเป็นขั้นตอนแรกคือ Classification คือทำนายว่าฝนตกหรือไม่ตก (ปริมาณน้ำฝนเป็น 0 มิลลิเมตร หรือมากกว่า)
		แล้วจึงใช้ Regression Model ทำนายปริมาณฝนของส่วนที่ฝนตกต่อไป
	</p>
	<p class="content">
		โมเดลที่เลือกใช้ในการทำ Classification คือ K-Nearest Neighbor (KNN) ซึ่งได้ Normalize ค่าของตัวแปรต่างๆ
		ด้วยค่า z-score และถ่วงน้ำหนักตัวแปรตามความเกี่ยวเนื่องกันของตัวแปรนั้น กับปริมาณฝน และใช้
		แบ่งข้อมูลส่วน Trainng ให้มี Validation Dataset เพื่อใช้เลือกค่า K ที่ดีที่สุดของแต่ละสถานี และนำมาใช้ทำนายจริง
	</p>
	<p class="content">
		เมื่อตัดสินได้แล้วว่าฝนตกหรือไม่ ถ้าฝนไม่ตก ก็จะทำนายว่าปริมาณน้ำฝนในวันนั้นเป็น 0 แต่ถ้าฝนตก ก็จะนำข้อมูลนั้นมาเข้า
		SVM Model ซึ่งทำหน้าที่เป็น Regression Model เพื่อให้ได้ค่าทำนายของปริมาณน้ำฝนในวันนั้นๆ ออกมา
	</p>
	<h2>ผลการทำนาย</h2>
	<p class="content">
		จากวิธีการทำนายข้างต้น ได้ผลสรุปคือได้ค่า Root Mean Square Error (RMSE) เฉลี่ย 10.96 มิลลิเมตร
		และได้ค่า F1 Score ของการทำนายว่าฝนตก/ไม่ตก มีค่าอยู่ที่ 69.69%
	</p>
</div>
@stop
