@extends('page.master')
@section('title')
@if(Request::route()->getName() == 'datcauhoi') Đặt câu hỏi @else Chia sẻ bài viết @endif
@endsection
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{!! asset('') !!}">Trang chủ</a></li>
    <li class="breadcrumb-item active" aria-current="page">@if(Request::route()->getName() == 'datcauhoi') Đặt câu hỏi @else Chia sẻ bài viết @endif</li>
  </ol>
</nav>
@if (session('noti_success'))
  <div class="alert alert-success">
    {{ session('noti_success') }}
  </div>
@endif
@include('blocks.error')
<h3>Tạo bài viết</h3>
<form method="POST" accept-charset="UTF-8" role="form">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="text" name="txttitle" placeholder="Tiêu đề" class="form-control" rows="25" required="1" minlength="10">
	<div class="form-group wmd-panel">
    <div id="wmd-button-bar"></div>
    <textarea class="form-control wmd-input" id="wmd-input" placeholder="Nội Dung" rows="25" required="1" minlength="10" name="txtcontent" cols="50"></textarea>
  </div>
  <div id="wmd-preview" class="wmd-panel wmd-preview"></div>
  <div class="form-group">
  	<label><b>Thêm thẻ cho bài viết: (ví dụ: python,c++,web)</b></label>
  	<input type="text" name="txttag" placeholder="Mỗi thẻ cách nhau 1 dấu ','" class="form-control">
  </div>
  <button class="btn btn-primary" type="submit">Tạo bài viết</button>
</form>

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
@endsection