@extends('page.master')
@section('title', 'Thông báo')
@section('content')
<?php 
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Users;
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{!! asset('') !!}">Trang chủ</a></li>
    <li class="breadcrumb-item active" aria-current="page">Thông báo</li>
  </ol>
</nav>
@include('blocks.error')
<div class="row">
	<div class="col-md-8">
		<h4 class="float-left">Thông báo của bạn</h4>
		<a href="{!! asset('delete-all-noti') !!}" class="btn btn-primary float-right">Xóa toàn bộ thông báo</a>
		<div class="mt-5">
			@if (session('noti_success'))
			  <div class="alert alert-success">
			    {{ session('noti_success') }}
			  </div>
			@endif
			@foreach($noti as $item)
			<div class="noti-item border mb-1 p-2 rounded">
				@if($item->status == 1)
					<i class="fas fa-exclamation-circle text-danger"></i> 
				@else
					<i class="fas fa-exclamation-circle text-success"></i> 
				@endif
				<?php
					echo $item->content;
				?>
			</div>
			
			@endforeach
			{!! $noti->render('blocks.paginator') !!}
		</div>
	</div>
	<div class="col-md-4">
		@include('blocks.sidebar')
	</div>
</div>
<script type="text/javascript" src="{!! asset('public/assets/Markdown.Converter-Sanitizer-Editor-Extra.min.js?t=1535888258') !!}"></script>
<script type="text/javascript">
(function () {
	var converter = Markdown.getSanitizingConverter();

	Markdown.Extra.init(converter, {
		"table_class": "table",
		extensions: ["tables", "fenced_code_gfm"],
	});

	// converter.hooks.chain("preBlockGamut", function (text, rbg) {
	// 	return text.replace(/^ {0,3}""" *\n((?:.*?\n)+?) {0,3}""" *$/gm, function (whole, inner) {
	// 		return "<blockquote>" + rbg(inner) + "</blockquote>\n";
	// 	});
	// });

	var editor = new Markdown.Editor(converter);

	editor.run();

			window.onbeforeunload = function() {
			return '';
		};
	})();
</script>
<style type="text/css">
	.cmt-content p {
		margin-bottom: 3px;
	}
</style>
@endsection