@extends('page.master')
@section('title', $post->title)
@section('content')
<?php 
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Users;
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{!! asset('') !!}">Trang chủ</a></li>
    <li class="breadcrumb-item">@if($post->type == 'post') <a href="{!! asset('bai-viet') !!}">Bài viết chia sẽ</a> @else <a href="{!! asset('cau-hoi') !!}">Câu hỏi</a> @endif</li>
    <li class="breadcrumb-item active" aria-current="page">{!! $post->title !!}</li>
  </ol>
</nav>
@include('blocks.error')
<div class="row">
	<div class="col-md-8">
		<div class="row">
			<div class="col-xs-12 col-md-10">
				<h1 class="spacing" style="font-size: 24px;">{!! $post->title !!}</h1>
				<p class="m-0 text-secondary"><i class="fas fa-user text-success"></i> {!! $user->username !!}, đã đăng: <?php \Carbon\Carbon::setLocale('vi'); ?> {!! \Carbon\Carbon::createFromTimeStamp(strtotime($post["created_at"]))->diffForHumans() !!} <i class="fas fa-eye ml-3"></i> {!! $post->view !!}</p>
			</div>
			<div class="hidden-xs hidden-md col-md-2 vote-wrapper text-center">
				<i id="vote-btn" data-post="{!! route('vote', ['id' => $post->id]) !!}" class="w-100 fas fa-heart @if($voted <= 0) text-secondary @else text-danger @endif mt-2" style="font-size: 40px;"></i>
				<span id="count-vote" class="text-weight-light">{!! $post->count_vote !!}</span>
			</div>
		</div>
		
		<hr>
		<div class="content content-post">
			<?php 
				$parser = app('Indal\Markdown\Parser');
				$html = $parser->parse($post->content); 
				echo $html;
			?>
			<div class="tags w-100 mt-2 mb-2">
				@if($post->tags != "")
					<?php 
						$arr = explode(',', $post->tags);
					?>
					@foreach($arr as $item)
						<?php
							$slug = "";
							$ar = explode(' ', trim($item));
							if(count($ar) == 1) 
								$slug = trim($item);
							else
								$slug = str_slug(trim($item));
						?>
						<a href="{!! asset('tags') !!}/{!! $slug !!}" class="btn btn-secondary font-weight-light" style="padding: 0 10px;">{!! trim($item) !!}</a>
					@endforeach
				@endif
			</div>
			
			@if(Auth::check() && (Auth::User()->id == $post->user_id) )
			<a href="{!! asset('bai-viet/chinh-sua') !!}/{!! $post->id !!}" class="btn btn-primary">Chỉnh sửa</a>
			<a href="{!! asset('bai-viet/xoa') !!}/{!! $post->id !!}" class="btn btn-danger" onclick="return accept_del('Bạn chắc chắn muốn xóa bài viết này không?')">Xóa</a>
			@endif
		</div>
		<hr>
		<div class="cmt">
			
			@if (session('noti_success'))
		    <div class="alert alert-success">
	        {{ session('noti_success') }}
		    </div>
			@endif
			
			<h4 class="mt-3" style="font-size: 18px">Tất cả bình luận</h4>
			@if(count($cmt) > 0)
				@foreach($cmt as $item)
					<div class="card mb-2" id="cmt{!! $item->id !!}">
						<div class="card-header p-1" >
							<img class="rounded-circle" src="{!! $item->avatar !!}" width="30" height="30"> <b>{!! $item->username !!}</b> - <i>Đã đăng: <?php \Carbon\Carbon::setLocale('vi'); ?> {!! \Carbon\Carbon::createFromTimeStamp(strtotime($item["created_at"]))->diffForHumans() !!}</i>
						</div>
						<div class="cmt-content card-body p-2">
							<?php 
								$parser = app('Indal\Markdown\Parser');
								$html = $parser->parse($item->content); 
								echo $html;
							?>
							@if(Auth::check() && Auth::User()->id == $item->user_id)
							<a class="text-danger" href="{!! asset('delcmt') !!}/{!! $item->id !!}">Xóa bình luận</a>
							@endif
						</div>
					</div>
				@endforeach
			@else
				<div class="alert alert-warning" role="alert">
				  Chưa có bình luận nào
				</div>
			@endif
			<h4 style="font-size: 18px">Thêm bình luận</h4>
			@if(Auth::check())
			<form method="POST" action="{!! asset('commentto') !!}/{!! $post->id !!}" accept-charset="UTF-8" role="form">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group wmd-panel">
			    <div id="wmd-button-bar"></div>
			    <textarea class="form-control wmd-input" id="wmd-input" placeholder="Nội Dung" rows="2" required="1" minlength="10" name="txtcontent" cols="50"></textarea>
			  </div>
			  <div id="wmd-preview" class="wmd-panel wmd-preview"></div>
			  <button class="btn btn-primary" type="submit">Thêm bình luận</button>
			</form>
			@else
			<div class="alert alert-warning mb-3" role="alert">
			  <a href="{!! asset('dang-nhap') !!}">Đăng nhập</a> để có thể bình luận
			</div>
			@endif
		</div>
	</div>
	<div class="col-md-4">
		@include('blocks.sidebar')
	</div>
</div>

@if(Auth::check())
<script type="text/javascript" src="{!! asset('public/assets/Markdown.Converter.js') !!}"></script>
<script type="text/javascript" src="{!! asset('public/assets/Markdown.Sanitizer.js') !!}"></script>
<script type="text/javascript" src="{!! asset('public/assets/Markdown.Editor.js') !!}"></script>
<script type="text/javascript">
  (function () {
    var converter1 = Markdown.getSanitizingConverter();
    var editor1 = new Markdown.Editor(converter1);
    editor1.run();
  })();
</script>
@endif
<script type="text/javascript">
	$("#vote-btn").click(function(e){
		e.preventDefault();
		var url = $(this).attr("data-post");

		$.ajax({
      url: url,
      type: "get",
      dataType: "html",
      processData: false,
      error: function () {
        var html = '<div class="noti-alert alert alert-warning"> <span>Bạn đã vote bài viết này!</span> </div>';
        $('body').append(html);
        var e = $('.alert');
        e.delay(3000).slideUp("slow");
				setTimeout(function() {
					  e.remove();
					}, 4000);
      },
      success: function (response) {
      	if(response == "voted"){
      		var html = '<div class="noti-alert alert alert-warning"> <span>Bạn đã vote bài viết này!</span> </div>';
	        $('body').append(html);
	        var e = $('.alert');
	        e.delay(3000).slideUp("slow");
					setTimeout(function() {
						  e.remove();
						}, 4000);
      	} else if (response == "login"){
      		var html = '<div class="noti-alert alert alert-warning"> <span>Đăng nhập để vote bài viết này!</span> </div>';
	        $('body').append(html);
	        var e = $('.alert');
	        e.delay(3000).slideUp("slow");
					setTimeout(function() {
						  e.remove();
						}, 4000);
      	} else {
      		var html = '<div class="noti-alert alert alert-success"> <span>Vote thành công bài viết này!</span> </div>';
	        $('body').append(html);
	        var e = $('.alert');
	        $("#vote-btn").removeClass("text-secondary").addClass("text-danger");
	        var vote = parseInt($("#count-vote").html());
					vote = vote + 1;
					$("#count-vote").html(vote);
	        e.delay(3000).slideUp("slow");
					setTimeout(function() {
						  e.remove();
						}, 4000);
      	}
      },
      timeout: 30000
    });
	});
</script>
<style type="text/css">
	.cmt-content p {
		margin-bottom: 3px;
	}
	#vote-btn {
		cursor: pointer;
	}
	.noti-alert {
		position: fixed;
		top: 90px;
		left: 50%;
		right: 50%;
		transform: translate(-50%, -50%);
		width: 300px;
		max-width: 90%;
		text-align: center;
		z-index: 2000;
	}
</style>
@endsection