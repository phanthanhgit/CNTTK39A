@extends('page.master')
@section('title')
	Tất cả các thẻ
@endsection
@section('content')
<h3 class="text-center">Tags</h3>
@foreach($tags as $item)
	<a href="tags/{!! $item->slug !!}" class="btn btn-light pl-4 pr-4 pt-2 pb-2 mb-2"><h3 class="font-weight-light">{!! $item->name !!}</h3></a>
@endforeach
{!! $tags->render('blocks.paginator') !!}
@endsection