<?php 
	use App\Posts;
	$posts = Posts::join('users', 'users.id', '=', 'posts.user_id')->select('posts.*', 'users.username', 'users.avatar')->where('type', 'post')->orderBy('view', 'desc')->limit(5)->get();
	$qas = Posts::join('users', 'users.id', '=', 'posts.user_id')->select('posts.*', 'users.username', 'users.avatar')->where('type', 'question')->orderBy('view', 'desc')->limit(5)->get();
?>
<div class="card">
	<div class="card-header">
		<h5 class="m-0">Bài viết hot</h5>
	</div>
	<ul class="list-group list-group-flush">
		@foreach($posts as $item)
    <li class="list-group-item">
    	<a class="text-dark font-weight-bold" href="{!! asset('/bai-viet') !!}/{!! $item->slug !!}.{!! $item->id !!}" style="display: inherit;">{!! $item->title !!}</a>
    	<p class="m-0 text-secondary"><i class="fas fa-user text-success"></i> {!! $item->username !!}, đã đăng: <?php \Carbon\Carbon::setLocale('vi'); ?> {!! \Carbon\Carbon::createFromTimeStamp(strtotime($item["created_at"]))->diffForHumans() !!}</p>
    </li>
    @endforeach
  </ul>
</div>

<div class="card mt-2">
	<div class="card-header">
		<h5 class="m-0">Câu hỏi hot</h5>
	</div>
	<ul class="list-group list-group-flush">
		@foreach($qas as $item)
    <li class="list-group-item">
    	<a class="text-dark font-weight-bold" href="{!! asset('/bai-viet') !!}/{!! $item->slug !!}.{!! $item->id !!}" style="display: inherit;">{!! $item->title !!}</a>
    	<p class="m-0 text-secondary"><i class="fas fa-user text-success"></i> {!! $item->username !!}, đã đăng: <?php \Carbon\Carbon::setLocale('vi'); ?> {!! \Carbon\Carbon::createFromTimeStamp(strtotime($item["created_at"]))->diffForHumans() !!}</p>
    </li>
    @endforeach
  </ul>
</div>


