@extends('admin.master')
@section('title', 'Chỉnh sửa thẻ')
@section('content')
<section class="content-header">
  <h1>
    Quản lý thẻ
    <small>Thống kê, quản lý thẻ</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Quản lý thẻ</a></li>
  </ol>
</section>

<section class="content">
  <div class="row">
  	<div class="col-md-3"></div>
  	<div class="col-md-6">
  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Chỉnh sửa thẻ</h3>
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
        		@include('blocks.error')
            <div class="form-group">
              <label>Tên thẻ</label>
              <input type="text" class="form-control" name="txttag" placeholder="Tên thẻ" value="{!! $tag->name !!}">
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{!! route('alltag') !!}" class="btn btn-danger">Hủy</a>
          </div>
        </form>
      </div>
  	</div>
  	<div class="col-md-3"></div>
	</div>
</section>
@endsection