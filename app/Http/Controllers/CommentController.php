<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\CommentRequest;
use App\Users;
use App\Posts;
use App\Tags;
use DateTime;
use App\Noti;
use App\Comments;

class CommentController extends Controller
{
  public function postCmt($id, CommentRequest $request){
  	$post = Posts::findOrFail($id);

  	$cmt = new Comments;
  	$cmt->content = $request->txtcontent;
  	$cmt->post_id = $id;
  	$cmt->user_id = Auth::User()->id;
  	$cmt->save();

  	if($post->user_id != Auth::User()->id) {
  		$noti = new Noti;
	  	$noti->to_user = $post->user_id;
	  	$noti->save();
	  	$str = "<a class='text-dark' href='".route('showpost', ['slug' => $post->slug, 'id' => $post->id])."?noti=".$noti->id."#cmt".$cmt->id."'><b>".Auth::User()->username."</b> đã thêm một bình luận vào bài viết của bạn </a><br><p class='text-secondary m-0' style='font-size: 14px;'><i class='fas fa-user-clock'></i> ".$cmt->created_at."</p>";
	  	$noti->content = $str;
	  	$noti->save();
  	}
  	
    $cmts = Comments::select('user_id')->where([['post_id', $id], ['user_id', '<>', Auth::User()->id], ['user_id', '<>', $post->user_id]])->groupBy('user_id')->get();
    foreach($cmts as $item){
      $noti = new Noti;
      $noti->to_user = $item->user_id;
      $noti->save();
      $str = "<a class='text-dark' href='".route('showpost', ['slug' => $post->slug, 'id' => $post->id])."?noti=".$noti->id."#cmt".$cmt->id."'><b>".Auth::User()->username."</b> đã thêm một bình luận vào bài viết <b><i>".$post->title."</i></b></a><br><p class='text-secondary m-0' style='font-size: 14px;'><i class='fas fa-user-clock'></i> ".$cmt->created_at."</p>";
      $noti->content = $str;
      $noti->save();
    }

  	return redirect()->back()->with('noti_success', 'Thêm bình luận thành công!');
  }

  public function delCmt($id) {
  	$cmt = Comments::findOrFail($id);
  	if($cmt->user_id == Auth::User()->id){
  		$cmt->delete();
  	}
		return redirect()->back();
  }
}
