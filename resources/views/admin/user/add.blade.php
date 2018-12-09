@extends('admin.master')
@section('title', 'Thêm tài khoản mới')
@section('content')
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
          <h3 class="box-title">Thêm tài khoản mới</h3>
        </div>
        <form role="form" method="post">
        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="box-body">
        		@include('blocks.error')
            <div class="form-group">
              <label>Tên đăng nhập</label>
              <input type="text" class="form-control" name="txtusername" placeholder="Tên đăng nhập">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" name="txtemail" placeholder="Email">
            </div>
            <div class="form-group">
              <label>Họ và tên</label>
              <input type="text" class="form-control" name="txtfullname" placeholder="Họ và tên">
            </div>
            <div class="form-group">
              <label>Mật khẩu</label>
              <input type="password" class="form-control" name="txtpassword" placeholder="Mật khẩu">
            </div>
            <div class="form-group">
              <label>Xác nhận mật khẩu</label>
              <input type="password" class="form-control" name="txtpassword_confirmation" placeholder="Xác nhận mật khẩu">
            </div>
            <div class="form-group">
              <label>Vai trò</label>
              <select class="form-control" name="txtlevel">
                <option value="1">Admin</option>
                <option value="2">Mod</option>
                <option value="3" selected="">Member</option>
              </select>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Thêm</button>
          </div>
        </form>
      </div>
  	</div>
  	<div class="col-md-3"></div>
	</div>
</section>
@endsection