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
		<tr>
			<th>มีข้อมูลตั้งแต่วันที่</th>
			<td>{{date("d/m/Y", strtotime($info_station['start_date']))}}</td>
		</tr>
		<tr>
			<th>มีข้อมูลถึงวันที่</th>
			<td>{{date("d/m/Y", strtotime($info_station['end_date']))}}</td>
		</tr>
	</table>
</div>
