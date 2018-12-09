@extends('page.master')
@section('title', 'Thay đổi mật khẩu')
@section('content')
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="card">
        	<div class="card-header">
        		Thay đổi mật khẩu
        	</div>
        	<div class="card-body">
        		@include('blocks.error')
        		@if (session('error_login'))
        	    <div class="alert alert-danger">
                {{ session('error_login') }}
        	    </div>
        		@endif
        		<form method="post" action="">
        			<input type="hidden" name="_token" value="{{ csrf_token() }}">
        			<div class="form-group">
        				<label><i class="fas fa-lock"></i> Mật khẩu mới</label>
        				<input class="form-control" type="password" name="txtpassword" placeholder="Mật khẩu mới">
        			</div>
        			<div class="form-group">
        				<label><i class="fas fa-check-square"></i> Xác nhận mật khẩu mới</label>
        				<input class="form-control" type="password" name="txtpassword_confirmation" placeholder="Xác nhận mật khẩu mới">
        			</div>
        			<button type="submit" class="btn btn-primary">Xác nhập thay đổi</button>
        		</form>
        	</div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
@endsection