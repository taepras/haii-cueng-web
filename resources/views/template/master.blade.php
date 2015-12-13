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
    <link href="{{url().'/css/haii-web.css'}}" rel="stylesheet" type="text/css">
    <link href="{{url().'/fonts/boon.css'}}" rel="stylesheet" type="text/css">
    <script src="{{url().'/js/d3.min.js'}}" charset="utf-8"></script>
    <script src="{{url().'/js/c3.min.js'}}"></script>
    <script src="{{url().'/js/dimple.latest.min.js'}}"></script>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{url()}}">หน้าแรก</a></li>
                    <li><a href="{{url().'/forecast'}}">ผลการพยากรณ์</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            รายละเอียดการพยากรณ์ <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url().'/methodology'}}">วิธีการพยากรณ์</a></li>
                            <li><a href="{{url().'/test_results'}}">ผลการทดสอบ</a></li>
                        </ul>
                    </li>
                    <li><a href="{{url().'/about'}}">เกี่ยวกับโครงการ</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container text-center">
        <div class="row">
            @yield('page-header')
        </div>
        <br><br><br>
        @yield('divider')
        <div class="row">
            @yield('content')
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

@yield('script')
