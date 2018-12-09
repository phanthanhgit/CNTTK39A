@extends('page.master')
@section('title', 'Đăng nhập')
@section('content')
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="card">
        	<div class="card-header">
        		Đăng nhập
        	</div>
        	<div class="card-body">
        		@if (session('error_login'))
        	    <div class="alert alert-danger">
                {{ session('error_login') }}
        	    </div>
        		@endif
        		<form method="post" action="">
        			<input type="hidden" name="_token" value="{{ csrf_token() }}">
        			<div class="form-group">
        				<label>Email</label>
        				<input class="form-control" type="email" name="txtemail" placeholder="Email">
        			</div>
        			<div class="form-group">
        				<label>Mật khẩu</label>
        				<input class="form-control" type="password" name="txtpassword" placeholder="Mật khẩu">
        			</div>
        			<button type="submit" class="btn btn-primary">Đăng nhập</button>
        		</form>
        	</div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>

@endsection