<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="{!! asset('public') !!}/assets/img/codedao.png" rel="shortcut icon">
  <link href="{!! asset('public') !!}/assets/img/codedao.png" rel="apple-touch-icon-precomposed">
  <title> @yield('title') </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{!! asset('public/assets') !!}/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{!! asset('public/assets') !!}/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{!! asset('public/assets') !!}/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{!! asset('public/assets') !!}/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{!! asset('public/assets') !!}/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{!! asset('public/assets') !!}/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{!! asset('public/assets') !!}/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{!! asset('public/assets') !!}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{!! asset('public/assets') !!}/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{!! asset('public/assets') !!}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!-- [if lt IE 9]> -->
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <!-- <![endif] -->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" type="text/css" href="{!! asset('public/assets/main.css') !!}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{!! route('admin') !!}" class="logo">
      <span class="logo-mini">AD</span>
      <span class="logo-lg">AD</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
              <img src="{!! Auth::User()->avatar !!}" class="user-image" alt="User Image">
              <span class="hidden-xs">{!! Auth::User()->username !!}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{!! Auth::User()->avatar !!}" class="img-circle" alt="User Image">

                <p>
                  {!! Auth::User()->fullname !!}
                  <small>{!! Auth::User()->username !!}</small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-center">
                  <a href="{!! route('dangxuat') !!}" class="btn btn-default">Đăng xuất</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="">
          <a href="{!! route('admin') !!}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Quản lý người dùng</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{!! route('alluser') !!}"><i class="fa fa-circle-o"></i> Tất cả người dùng</a></li>
            <li><a href="{!! route('adduser') !!}"><i class="fa fa-circle-o"></i> Thêm người dùng</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-tag"></i> <span>Quản lý thẻ</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{!! route('alltag') !!}"><i class="fa fa-circle-o"></i> Tất cả thẻ</a></li>
            <li><a href="{!! route('addtag') !!}"><i class="fa fa-circle-o"></i> Thêm thẻ</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>Quản lý bài viết</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{!! route('allpost') !!}"><i class="fa fa-circle-o"></i> Tất cả bài viết</a></li>
            <li><a href="{!! route('addpost') !!}"><i class="fa fa-circle-o"></i> Thêm bài viết</a></li>
          </ul>
        </li>
        <li>
          <a href="{!! route('allcmt') !!}">
            <i class="fa fa-comments"></i> <span>Quản lý bình luận</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <div class="content-wrapper">
    @yield('content')
  </div>

</div>
    
<script src="{!! asset('public/assets') !!}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{!! asset('public/assets') !!}/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{!! asset('public/assets') !!}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="{!! asset('public/assets') !!}/bower_components/raphael/raphael.min.js"></script>
<script src="{!! asset('public/assets') !!}/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="{!! asset('public/assets') !!}/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="{!! asset('public/assets') !!}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{!! asset('public/assets') !!}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="{!! asset('public/assets') !!}/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{!! asset('public/assets') !!}/bower_components/moment/min/moment.min.js"></script>
<script src="{!! asset('public/assets') !!}/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="{!! asset('public/assets') !!}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{!! asset('public/assets') !!}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="{!! asset('public/assets') !!}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{!! asset('public/assets') !!}/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{!! asset('public/assets') !!}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{!! asset('public/assets') !!}/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{!! asset('public/assets') !!}/dist/js/demo.js"></script>

<script type="text/javascript">
  $('.alert').delay(3000).slideUp();
  function accept_del(msg){
    if(window.confirm(msg)){
      return true;
    }
      return false;
  }
</script>
</body>
</html>
