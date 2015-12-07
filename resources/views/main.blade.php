<!DOCTYPE html>
<html>
<head>
   <title>Rain Prediction using R</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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

   <header class="text-center">
      <div class="container">
         <h1>ระบบพยากรณ์ปริมาณฝนในประเทศไทย</h1>
         <p>โดยวิธี Data Mining บนข้อมูลภูมิอากาศจาก CFSv2 และข้อมูลฝนกรมจากอุตุนิยมวิทยา</p>
         <br>
         <a class="btn btn-default">ดูรายละเอียดการพยากรณ์ &raquo;</a>
      </div>
   </header>
   <div class="container main-content">
      <div class="row">
         <div class="col-sm-4" style="background-color:#eee; height:500px;">
            asdf;lkajsdf;lkj
         </div>
         <div class="col-sm-4" style="background-color:#ddd; height:500px;">
            asdf;lkajsdf;lkj
         </div>
         <div class="col-sm-4" style="background-color:#eee; height:500px;">
            asdf;lkajsdf;lkj
         </div>
      </div>
   </div>
   <footer class="container">
      <div class="row">
         <div class="col-sm-12 text-center">
            <img src="{{url().'/img/logo_haii.gif'}}" style="height:100px;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="{{url().'/img/logo_chulaengineering.png'}}" style="height:50px;">
         </div>
      </div>
   </footer>
   <!-- <nav class="navbar nav navbar-default">
      <ul class="navbar-right nav">
         <li>หน้าหลัก</li>
         <li>พยากรณ์ล่วงหน้า</li>
         <li>ผลการพยากรณ์ย้อนหลัง</li>
         <li>รายละเอียดการทำนาย</li>
         <ul>
            <li>paper</li>
            <li>ผลการทดสอบ (ตอนทำ k-fold)</li>
         </ul>
      </ul>
   </nav> -->
</body>
</html>
