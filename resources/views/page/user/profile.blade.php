@extends('page.master')
@section('title')
	{!! $user['username'] !!}
@endsection
@section('content')

<div class="row">
	<div class="col-md-4">
		<div class="p-3 border">
			<img src="{!! $user->avatar !!}" class="w-100 rounded-circle">
			<h4 class="text-center mt-3">{!! $user->username !!}</h4>
		</div>
	</div>
	<div class="col-md-8">
		@if (session('noti_success'))
	    <div class="alert alert-success">
        {{ session('noti_success') }}
	    </div>
		@endif
		<h4 class="">Thông tin cá nhân</h4>
		@if(Auth::check() && Auth::User()->username == $user->username)
		<form method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="form-group">
				<label><b><i class="fas fa-user-ninja"></i> Tên người dùng</b></label>
				<input type="text" class="form-control" value="{!! $user->username !!}" disabled="">
			</div>
			<div class="form-group">
				<label><b><i class="far fa-user"></i> Họ và tên:</b></label>
				<input type="text" class="form-control" value="{!! $user->fullname !!}" name="txtfullname">
			</div>
			<div class="form-group">
				<label><b><i class="fas fa-at"></i> Email</b></label>
				<input type="text" class="form-control" value="{!! $user->email !!}" disabled="">
			</div>
			<a href="{!! asset('change-password') !!}" class="btn btn-warning">Thay đổi mật khẩu</a>
			<button type="submit" class="btn btn-primary">Cập nhật</button>
		</form>
		@else
		<div class="font-weight-light">
			<h5 class="font-weight-light"><i class="fas fa-user-ninja"></i> Tên người dùng: {!! $user->username !!}</h5>
			<h5 class="font-weight-light"><i class="far fa-user"></i> Họ và tên: {!! $user->fullname !!}</h5>
			<h5 class="font-weight-light"><i class="fas fa-at"></i> Email: {!! $user->email !!}</h5>
			<h5 class="font-weight-light"><i class="fas fa-user-clock"></i> Ngày tham gia: {!! $user->created_at !!}</h5>
			
		</div>
		@endif
		<hr>
		<h4 class="">Hoạt đồng gần đây:</h4>
		@if(count($posts) > 0)
			@foreach($posts as $item)
			<div class="border mb-1 p-2 rounded">
				<p class="m-0 text-secondary"><i class="fas fa-user text-success"></i> {!! $item->username !!}, đã đăng: <?php \Carbon\Carbon::setLocale('vi'); ?> {!! \Carbon\Carbon::createFromTimeStamp(strtotime($item["created_at"]))->diffForHumans() !!}</p>
				<a class="text-dark" href="{!! asset('/bai-viet') !!}/{!! $item->slug !!}.{!! $item->id !!}"><h5>{!! $item->title  !!}</h5></a>
				@if($item->tags != "")
					<?php 
						$arr = explode(',', $item->tags);
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
						<a href="{!! asset('tags') !!}/{!! $slug !!}" class="btn btn-secondary" style="padding: 0 10px;">{!! trim($item) !!}</a>
					@endforeach
				@endif
			</div>
			
			@endforeach
			{!! $posts->render('blocks.paginator') !!}
		@else
			<div class="alert alert-warning" role="alert">
			  Người dùng không thích hoạt động cho lắm
			</div>
		@endif
	</div>
</div>
@endsection