@extends('admin.master')
@section('title', 'Quản lý bài viết')
@section('content')
<section class="content-header">
  <h1>
    Quản lý bài viết
    <small>Thống kê, quản lý bài viết</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Quản lý bài viết</a></li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Danh sách bài viết</h3>
        </div>
        <div class="box-body">
        	<h5><a class="btn btn-primary" href="{!! route('addpost') !!}">Thêm bài viết mới</a></h5>

          <form method="get">
            <label>Tìm kiếm</label>
            <div class="input-group input-group-sm">
              <input type="text" class="form-control" name="key" placeholder="Nhập từ khóa tìm kiếm">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
          </form>
          
        	@if (session('noti_success'))
					  <div class="alert alert-success">
					    {{ session('noti_success') }}
					  </div>
					@endif
          <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
            <tr role="row">
            		<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
            		<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Tiêu đề</th>
            		<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Người đăng</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Thể loại</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Lượt xem</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Lượt vote</th>
            		<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Ngày tạo</th>
            		<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Thao tác</th></tr>
            </thead>
            <tbody>
            	@foreach($posts as $item)
	            <tr role="row" class="odd">
	              <td class="sorting_1">{!! $item->id !!}</td>
	              <td>{!! $item->title !!}</td>
	              <td>{!! $item->username !!}</td>
	              <td>{!! $item->type !!}</td>
                <td>{!! $item->view !!}</td>
                <td>{!! $item->count_vote !!}</td>
	              <td><?php \Carbon\Carbon::setLocale('vi'); ?> {!! \Carbon\Carbon::createFromTimeStamp(strtotime($item["created_at"]))->diffForHumans() !!}</td>
	              <td><a href="{!! route('delpost', ['id' => $item->id ]) !!}" onclick="return accept_del('Bạn chắc chắn muốn xóa bài viết này không?')">Xóa</a> - <a href="{!! route('detailpost', ['id' => $item->id]) !!}">Chi tiết</a></td>
	            </tr>
	            @endforeach
	          </tbody>
	        </table>
	      	{!! $posts->render('blocks.paginator1') !!}
        </div>
      </div>
    </div>
  </div>
</section>
@endsection