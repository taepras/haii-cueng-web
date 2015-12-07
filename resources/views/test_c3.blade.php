<!DOCTYPE html>
<html>
<head>
   <title>Rain Prediction using R</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
   <script src="{{url().'/js/jquery-1.11.3.min.js'}}" charset="utf-8"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
   <link href="{{url().'/css/c3.min.css'}}" rel="stylesheet" type="text/css">
   <script src="{{url().'/js/d3.min.js'}}" charset="utf-8"></script>
   <script src="{{url().'/js/c3.min.js'}}"></script>
   <style>
   .navbar .navbar-nav {
      display: inline-block;
      float: none;
      padding-top:20px;
   }
   .navbar-default{
      background-color: transparent;
      border: none;
   }
   .navbar .navbar-collapse {
      text-align: center;
   }
   .page{
      text-align: center;
   }
   header{
      padding:20px 0 50px;
      margin-bottom:20px;
   }
   footer{
      padding:20px 0 50px;
      margin-top:20px;
   }
   hr{border-color:#ccc;}
   .main-content{
      border-top:1px #ccc solid;
      border-bottom:1px #ccc solid;
      padding:30px;
   }
   .container{
      max-width:960px;
   }
   </style>
</head>
<body>
   <nav class="navbar navbar-default">
      <div class="container-fluid">
         <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
               <li><a href="#">หน้าแรก</a></li>
               <li><a href="#">ผลการพยากรณ์</a></li>
               <li><a href="#">รายละเอียดการพยากรณ์</a></li>
               <li><a href="#">เกี่ยวกับโครงการ</a></li>
            </ul>
         </div>
      </div>
   </nav>

   <div class="container text-center">
      <h1>ผลการทดสอบ Model</h1>
      <p>
         ตั้งแต่วันที่ xx-xx-xx ถึง xx-xx-xx<br>
         เปรียบเทียบปริมาณน้ำฝนต่อวันจริง และปริมาณน้ำฝนที่ทำนายได้
      </p>
      <br><br>
      <div class="row">
         <div class="col-sm-12">
            <div id="chart"></div>
         </div>
      </div>
   </div>
   <footer class="container">
      <hr>
      <div class="row">
         <div class="col-sm-12 text-center">
            <img src="{{url().'/img/logo_haii.gif'}}" style="height:100px;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="{{url().'/img/logo_chulaengineering.png'}}" style="height:50px;">
         </div>
      </div>
   </footer>
</body>
</html>

<script>
var chart = c3.generate({
   data: {
      x: 'date',
      url: '{{url().'/test/300201_edited_s.csv'}}',
      type: 'line',
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

/*
var chart = c3.generate({
bindto: '#chart',
data: {
url: '{{url().'/test/300201_edited_s.csv'}}',
x: 'x',
columns: [
['x', '2013-01-01', '2013-01-02', '2013-01-03', '2013-01-04', '2013-01-05', '2013-01-06'],
['predicted', 30, 200, 100, 400, 150, 250, 10, 140, 30, 50, 100],
['actual', 50, 20, 10, 40, 15, 100, 40, 15, 100, 20, 10]
]
},
axis: {
x: {
type: 'timeseries',
tick: {
format: '%Y-%m-%d'
}
},
y: {
label: {
text: 'rainfall (mm)',
position: 'outer-middle'
}
}
},
grid: {
x: {
show: true
},
y: {
show: true
}
},
size: {
height: 500
}
});
*/
</script>
