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
          <h3 class="box-title">Chi tiết tài khoản</h3>
        </div>
        @if (session('noti_success'))
          <div class="alert alert-success">
            {{ session('noti_success') }}
          </div>
        @endif
        <form role="form" method="post">
        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="box-body">
        		@include('blocks.error')
            <div class="form-group">
              <label>Tên đăng nhập</label>
              <input type="text" value="{!! $user->username !!}" class="form-control" name="txtusername" placeholder="Tên đăng nhập">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" value="{!! $user->email !!}" class="form-control" name="txtemail" placeholder="Email">
            </div>
            <div class="form-group">
              <label>Họ và tên</label>
              <input type="text" value="{!! $user->fullname !!}" class="form-control" name="txtfullname" placeholder="Họ và tên">
            </div>
            <div class="form-group">
              <label>Vai trò</label>
              <select class="form-control" name="txtlevel">
                <option value="1" @if($user->level == 1) selected @endif>Admin</option>
                <option value="2" @if($user->level == 2) selected @endif>Mod</option>
                <option value="3" @if($user->level == 3) selected @endif>Member</option>
              </select>
            </div>
            <div class="form-group">
              <a href="{!! route('changepassuser', ['id' => $user->id]) !!}" class="btn btn-warning">Thay đổi mật khẩu</a>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{!! route('alluser') !!}" class="btn btn-danger">Hủy</a>
          </div>
        </form>
      </div>
  	</div>
  	<div class="col-md-3"></div>
	</div>
</section>
@endsection