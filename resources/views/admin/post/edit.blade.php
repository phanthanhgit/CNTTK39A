@extends('admin.master')
@section('title', 'Chỉnh sửa bài viết')
@section('content')
<section class="content-header">
  <h1>
    Quản lý bài viết
    <small>Thống kê, quản lý bài viết của thành viên</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Quản lý bài viết</a></li>
  </ol>
</section>

<section class="content">
  <div class="row">
  	<div class="col-md-6">
  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Chỉnh sửa bài viết</h3>
        </div>
        <div class="box-body">
          @if (session('noti_success'))
            <div class="alert alert-success">
              {{ session('noti_success') }}
            </div>
          @endif
          <form method="POST" accept-charset="UTF-8" role="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" name="txttitle" value="{!! $post->title !!}" placeholder="Tiêu đề" class="form-control" rows="25" required="1" minlength="10">
            <div class="form-group">
              <label>Chọn loại bài viết</label>
              <select class="form-control" name="txttype">
                <option value="post" @if($post->type == 'post') selected @endif>Chia sẻ</option>
                <option value="question" @if($post->type == 'question') selected @endif>Câu hỏi</option>
              </select>
            </div>
            <div class="form-group wmd-panel">
              <div id="wmd-button-bar"></div>
              <textarea class="form-control wmd-input" id="wmd-input" placeholder="Nội Dung" rows="25" required="1" minlength="10" name="txtcontent" cols="50">{!! $post->content !!}</textarea>
            </div>
            <div class="form-group">
              <label><b>Thêm thẻ cho bài viết: (ví dụ: python,c++,web)</b></label>
              <input type="text" value="{!! $post->tags !!}" name="txttag" placeholder="Mỗi thẻ cách nhau 1 dấu ','" class="form-control">
            </div>
            <button class="btn btn-primary" type="submit">Cập nhật bài viết</button>
            <a href="{!! route('allpost') !!}" class="btn btn-danger">Hủy</a>
          </form>
        </div>
      </div>
  	</div>
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Xem trước hiển thị</h3>
        </div>
        <div class="box-body">
          <div id="wmd-preview" class="wmd-panel wmd-preview"></div>
        </div>
      </div>
    </div>
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