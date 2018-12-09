@extends('admin.master')
@section('title', 'Dashboard')
@section('content')
<section class="content-header">
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<section class="content">
	<div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{!! $users !!}</h3>

          <p>Người dùng</p>
        </div>
        <div class="icon">
          <i class="ion ion-person"></i>
        </div>
        <a href="{!! route('alluser') !!}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{!! $posts !!}</h3>

          <p>Chia sẻ</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-book"></i>
        </div>
        <a href="{!! route('allpost') !!}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{!! $asks !!}</h3>

          <p>Câu hỏi</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-help"></i>
        </div>
        <a href="{!! route('allpost') !!}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{!! $tags !!}</h3>

          <p>Thẻ</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-pricetag"></i>
        </div>
        <a href="{!! route('alltag') !!}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
</section>
@endsection