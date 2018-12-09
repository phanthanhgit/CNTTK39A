@extends('admin.master')
@section('title', 'Chi tiết tài khoản')
@section('content')
<?php 
use Illuminate\Support\Facades\Hash;
?>
<section class="content-header">
  <h1>
    Quản lý người dùng
    <small>Thống kê, quản lý tài khoản thành viên</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Quản lý người dùng</a></li>
  </ol>
</section>

<section class="content">
  <div class="row">
  	<div class="col-md-3"></div>
  	<div class="col-md-6">
  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Thay đổi mật khẩu</h3>
        </div>
        <form role="form" method="post">
        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="box-body">
        		@include('blocks.error')
            <div class="form-group">
              <label>Mật khẩu mới</label>
              <input type="password" class="form-control" name="txtpassword" placeholder="Mật khẩu">
            </div>
            <div class="form-group">
              <label>Xác nhận mật khẩu</label>
              <input type="password" class="form-control" name="txtpassword_confirmation" placeholder="Xác nhận mật khẩu">
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Thay đổi</button>
            <a href="{!! route('detailuser', ['id' => $id]) !!}" class="btn btn-danger">Hủy</a>
          </div>
        </form>
      </div>
  	</div>
  	<div class="col-md-3"></div>
	</div>
</section>
@endsection