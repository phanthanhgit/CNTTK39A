<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="author" content="phanthanhblog.com" />
<link href="{!! asset('public') !!}/assets/img/codedao.png" rel="shortcut icon">
  <link href="{!! asset('public') !!}/assets/img/codedao.png" rel="apple-touch-icon-precomposed">
  
  <title> @yield('title') </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="text/javascript" src="{!! asset('public/assets/jquery.min.js') !!}"></script>
  <link rel="stylesheet" type="text/css" href="{!! asset('public/assets/css/bootstrap.min.css') !!}">
  <script type="text/javascript" src="{!! asset('public/assets/js/bootstrap.min.js') !!}"></script>
  <script type="text/javascript" src="{!! asset('public/assets/popper.js') !!}"></script>
  <link rel="stylesheet" type="text/css" href="{!! asset('public/assets/main.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('public/assets/all.css') !!}">
  <link href="https://fonts.googleapis.com/css?family=Amatic+SC|Arima+Madurai|Lobster|Noto+Sans:400,700|Patrick+Hand+SC|Material+Icons" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom sticky-top">
		<div class="container">
			<a class="navbar-brand" href="{!! asset('') !!}"><b>CNTTK39A.vn</b></a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav navbar-left">
		      <li class="nav-item @if(Request::route()->getName() == 'home') active @endif">	
		        <a class="nav-link ml-2 mr-2" href="{!! asset('') !!}"><i class="fas fa-home"></i> Trang chủ</a>
		      </li>
		      <li class="nav-item @if(Request::route()->getName() == 'showallpost') active @endif">
		        <a class="nav-link ml-2 mr-2" href="{!! asset('bai-viet') !!}"><i class="fas fa-book"></i> Bài viết</a>
		      </li>
		      <li class="nav-item @if(Request::route()->getName() == 'showallqa') active @endif">
		        <a class="nav-link ml-2 mr-2" href="{!! asset('cau-hoi') !!}"><i class="fas fa-question-circle"></i> Câu hỏi</a>
		      </li>
		    </ul>
		    <form action="{!! asset('search') !!}" method="GET" accept-charset="UTF-8" class="navbar-form navbar-left mr-auto">
					<div class="input-group">
					  <input type="text" class="form-control" placeholder="Tìm kiếm..." aria-label="Tìm kiếm..." aria-describedby="button-addon2" name="key">
					  <div class="input-group-append">
					    <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
					  </div>
					</div>
				</form>
		    <ul class="navbar-nav navbar-right">
		    	@if(Auth::check())
	    	 	@include('blocks.bell')
		    	<li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          <i class="fas fa-pen-alt"></i>
		        </a>
		        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
		        	<div class="arrow-up"></div>
		        	<a class="dropdown-item" href="{!! asset('dang-bai') !!}">Chia sẻ bài viết</a>
		          <a class="dropdown-item" href="{!! asset('dat-cau-hoi') !!}">Đặt câu hỏi</a>
		          
		        </div>
		      </li>
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          <img src="{!! Auth::User()->avatar_path !!}" class="rounded" width="20" alt="Ảnh đại diện">
		        </a>
		        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
		        	<div class="arrow-up"></div>
		        	<a class="dropdown-item" href="{!! asset('profile') !!}/{!! Auth::User()->username !!}">Cá nhân</a>
		        	@if(Auth::User()->level < 3)
		        	<a class="dropdown-item" href="{!! asset('pt64admin') !!}">Admin</a>
		        	@endif
		        	<div class="dropdown-divider"></div>
		          <a class="dropdown-item" href="{!! asset('dang-xuat') !!}">Đăng xuất</a>
		          
		        </div>
		      </li>
		      @else
		      <li class="nav-item mr-2">
		      	<a href="{!! asset('dang-nhap') !!}" class="btn btn-outline-secondary">Đăng nhập</a>
		      </li>
		      <li class="nav-item">
		      	<a href="{!! asset('dang-ky') !!}" class="btn btn-outline-primary">Đăng ký</a>
		      </li>
		      @endif
		    </ul>
			</div>
	  </div>
	</nav>
	<div class="container mt-3 mb-3">
		@yield('content')
	</div>
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