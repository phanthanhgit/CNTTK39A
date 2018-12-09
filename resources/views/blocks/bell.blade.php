<?php
	use App\Noti;
	$noti = Noti::select()->where('to_user', Auth::User()->id)->get()->toArray();
	$count = Noti::select()->where([['to_user', Auth::User()->id], ['status', '1']])->count();
?>
@if($count > 0)
<li class="nav-item mr-2">
	<a href="{!! asset('thong-bao') !!}" class="nav-link text-danger"><i class="fas fa-bell"></i> <span class="badge badge-light"><?php if($count > 99) echo "NN"; else echo $count; ?></span></a>
</li>
@else
<li class="nav-item mr-2">
	<a href="{!! asset('thong-bao') !!}" class="nav-link"><i class="fas fa-bell"></i></a>
</li>
@endif