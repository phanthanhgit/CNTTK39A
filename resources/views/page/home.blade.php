@extends('page.master')
@section('title', 'Trang chủ')
@section('content')
<div class="row">
	<div class="col-md-8">
		<h4>Chia sẻ mới nhất:</h4>
		@foreach($posts as $item)
		<div class="border mb-1 p-2 rounded">
			<p class="m-0 text-secondary"><i class="fas fa-user text-success"></i> {!! $item->username !!}, đã đăng: <?php \Carbon\Carbon::setLocale('vi'); ?> {!! \Carbon\Carbon::createFromTimeStamp(strtotime($item["created_at"]))->diffForHumans() !!}</p>
			<a class="text-dark" href="{!! asset('/bai-viet') !!}/{!! $item->slug !!}.{!! $item->id !!}"><h5 class="spacing">{!! $item->title  !!}</h5></a>
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
					<a href="{!! asset('tags') !!}/{!! $slug !!}" class="btn btn-secondary font-weight-light" style="padding: 0 10px;">{!! trim($item) !!}</a>
				@endforeach
			@endif
		</div>
		@endforeach
		<div class="alert alert-warning" role="alert">
			Xem nhiều hơn tại mục <a href="{!! asset('/bai-viet') !!}">bài viết</a>
		</div>

		<hr>

		<h4>Câu hỏi mới nhất:</h4>
		@foreach($qas as $item)
		<div class="border mb-1 p-2 rounded">
			<p class="m-0 text-secondary"><i class="fas fa-user text-success"></i> {!! $item->username !!}, đã đăng: <?php \Carbon\Carbon::setLocale('vi'); ?> {!! \Carbon\Carbon::createFromTimeStamp(strtotime($item["created_at"]))->diffForHumans() !!}</p>
			<a class="text-dark" href="{!! asset('/bai-viet') !!}/{!! $item->slug !!}.{!! $item->id !!}"><h5 class="spacing">{!! $item->title  !!}</h5></a>
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
					<a href="{!! asset('tags') !!}/{!! $slug !!}" class="btn btn-secondary font-weight-light" style="padding: 0 10px;">{!! trim($item) !!}</a>
				@endforeach
			@endif
		</div>
		@endforeach
		<div class="alert alert-warning" role="alert">
			Xem nhiều hơn tại mục <a href="{!! asset('/cau-hoi') !!}">câu hỏi</a>
		</div>
	</div>
	<div class="col-md-4">
		@include('blocks.sidebar')
	</div>
</div>
@endsection