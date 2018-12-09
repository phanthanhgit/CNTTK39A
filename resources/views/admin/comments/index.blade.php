@extends('admin.master')
@section('title', 'Quản lý bình luận')
@section('content')
<section class="content-header">
  <h1>
    Quản bình luận
    <small>Thống kê, quản lý bình luận của thành viên</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Quản lý bình luận</a></li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Danh sách bình luận</h3>
        </div>
        <div class="box-body">
          @if (session('noti_success'))
            <div class="alert alert-success">
              {{ session('noti_success') }}
            </div>
          @endif
          <form method="get">
            <label>Tìm kiếm</label>
            <div class="input-group input-group-sm">
              <input type="text" class="form-control" name="key" placeholder="Nhập từ khóa tìm kiếm">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
          </form>
          <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
            <tr role="row">
            		<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="min-width: 50px;">ID</th>
            		<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="min-width: 130px;">Người dùng</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Nội dung</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Bài viết</th>
            		<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="min-width: 125px;">Ngày tạo</th>
            		<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="min-width: 100px;">Thao tác</th></tr>
            </thead>
            <tbody>
            	@foreach($cmts as $item)
	            <tr role="row" class="odd">
	              <td class="sorting_1">{!! $item->id !!}</td>
	              <td>{!! $item->username !!}</td>
                <td>{!! $item->content !!}</td>
                <td><a target="_blank" href="{!! route('showpost', ['slug' => $item->slug, 'id' => $item->postid]) !!}#cmt{!! $item->id !!}">{!! $item->title !!}</a></td>
	              <td><?php \Carbon\Carbon::setLocale('vi'); ?> {!! \Carbon\Carbon::createFromTimeStamp(strtotime($item["created_at"]))->diffForHumans() !!}</td>
	              <td><a href="{!! route('delcmt', ['id' => $item->id]) !!}" onclick="return accept_del('Bạn chắc chắn muốn xóa bình luận này không?')">Xóa</a> - <a href="{!! route('detailcmt', ['id' => $item->id]) !!}">Chi tiết</a></td>
	            </tr>
	            @endforeach
	          </tbody>
	        </table>
	      	{!! $cmts->render('blocks.paginator1') !!}
        </div>
      </div>
    </div>
  </div>
</section>
@endsection