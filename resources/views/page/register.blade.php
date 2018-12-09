@extends('page.master')
@section('title', 'Đăng nhập')
@section('content')
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="card">
        	<div class="card-header">
        		Đăng ký tài khoản
        	</div>
        	<div class="card-body">
        		@include('blocks.error')
        		<form method="post" action="">
        			<input type="hidden" name="_token" value="{{ csrf_token() }}">
        			<div class="form-group">
        				<label>Tên đăng nhập</label>
        				<input class="form-control" type="text" name="txtusername" placeholder="Tên đăng nhập">
        			</div>
        			<div class="form-group">
        				<label>Email</label>
        				<input class="form-control" type="email" name="txtemail" placeholder="Email">
        			</div>
        			<div class="form-group">
        				<label>Mật khẩu</label>
        				<input class="form-control" type="password" name="txtpassword" placeholder="Mật khẩu">
        			</div>
        			<div class="form-group">
        				<label>Xác nhận mật khẩu</label>
        				<input class="form-control" type="password" name="txtpassword_confirmation" placeholder="Xác nhận mật khẩu">
        			</div>
        			<button type="submit" class="btn btn-primary">Đăng ký</button>
        		</form>
        	</div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
@endsection