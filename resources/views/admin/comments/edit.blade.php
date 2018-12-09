@extends('admin.master')
@section('title', 'Chỉnh sửa bình luận')
@section('content')
<section class="content-header">
  <h1>
    Quản bình luận
    <small>Thống kê, quản lý bình luận của thành viên</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Quản lý bình luận</a></li>
  </ol>
</section>

<section class="content">
  <div class="row">
  	<div class="col-md-3"></div>
  	<div class="col-md-6">
  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Chỉnh sửa bình luận</h3>
        </div>
        @if (session('noti_success'))
          <div class="alert alert-success">
            {{ session('noti_success') }}
          </div>
        @endif
        @if (session('noti_fail'))
          <div class="alert alert-danger">
            {{ session('noti_fail') }}
          </div>
        @endif
        <form role="form" method="post">
        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="box-body">
            <label>Link bình luận: </label><a target="_blank" href="{!! route('showpost', ['slug' => $post->slug, 'id' => $post->id]) !!}#cmt{!! $cmt->id !!}">{!! route('showpost', ['slug' => $post->slug, 'id' => $post->id]) !!}#cmt{!! $cmt->id !!}</a>
        		@include('blocks.error')
            <div class="form-group">
              <label>Nội dung bình luận</label>
              <div class="form-group wmd-panel">
                <div id="wmd-button-bar"></div>
                <textarea class="form-control wmd-input" id="wmd-input" placeholder="Nội dung" rows="10" required="1" minlength="10" name="txtcontent" cols="50">{!! $cmt->content !!}</textarea>
              </div>
              <div id="wmd-preview" class="wmd-panel wmd-preview"></div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{!! route('allcmt') !!}" class="btn btn-danger">Hủy</a>
          </div>
        </form>
      </div>
  	</div>
  	<div class="col-md-3"></div>
	</div>
</section>
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