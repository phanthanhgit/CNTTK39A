<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\ChangePassRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserPostRequest;
use App\Users;
use App\Posts;
use App\Tags;
use DateTime;
use Avatar;

class PostController extends Controller
{
  public function getIndex(){
  	$key = "";
  	if(isset($_GET['key'])){
  		$key = $_GET['key'];
  	}
  	$posts = Posts::join('users', 'users.id', '=', 'posts.user_id')->where('users.username', 'like', '%'.$key.'%')->orWhere('users.email', 'like', '%'.$key.'%')->orWhere('posts.title', 'like', '%'.$key.'%')->orWhere('posts.content', 'like', '%'.$key.'%')->orWhere('posts.tags', 'like', '%'.$key.'%')->select('posts.*', 'users.username')->orderBy('created_at', 'desc')->paginate(20);
  	return view('admin.post.index', ['posts' => $posts]);
  }

  public function addPost(){
  	return view('admin.post.add');
  }

  public function postAddPost(UserPostRequest $request){
  	$post = new Posts;
		$post->user_id = Auth::User()->id;
		$post->title = $request->txttitle;
		$post->content = $request->txtcontent;
		$post->slug = str_slug($request->txttitle);
		$post->type = $request->txttype;
		$tags = trim($request->txttag);
		$post->tags = trim($request->txttag);
		if(strlen(trim($request->txttag)) > 0){
			$arr = explode(',', $tags);
			for($i = 0; $i < count($arr); $i++){
				$slug = "";
				$ar = explode(' ', trim($arr[$i]));
				if(count($ar) == 1) 
					$slug = trim($arr[$i]);
				else
					$slug = str_slug(trim($arr[$i]));
				$tag = Tags::where('slug', '=', $slug)->count();
				if($tag <= 0) {
					$tag = new Tags;
					$tag->name = trim($arr[$i]);
					$tag->slug = $slug;
					$tag->save();
				}
			}
		}
		$post->save();
		return redirect()->route('detailpost', ['id' => $post->id])->with('noti_success', 'Thêm bài viết thành công!');
  }

  public function editPost($id){
  	$post = Posts::findOrFail($id);
  	return view('admin.post.edit', ['post' => $post]);
  }

  public function postEditPost($id, UserPostRequest $request){
  	$post = Posts::findOrFail($id);
		$post->user_id = Auth::User()->id;
		$post->title = $request->txttitle;
		$post->content = $request->txtcontent;
		$post->slug = str_slug($request->txttitle);
		$post->type = $request->txttype;
		$tags = trim($request->txttag);
		$post->tags = trim($request->txttag);
		if(strlen(trim($request->txttag)) > 0){
			$arr = explode(',', $tags);
			for($i = 0; $i < count($arr); $i++){
				$slug = "";
				$ar = explode(' ', trim($arr[$i]));
				if(count($ar) == 1) 
					$slug = trim($arr[$i]);
				else
					$slug = str_slug(trim($arr[$i]));
				$tag = Tags::where('slug', '=', $slug)->count();
				if($tag <= 0) {
					$tag = new Tags;
					$tag->name = trim($arr[$i]);
					$tag->slug = $slug;
					$tag->save();
				}
			}
		}
		$post->save();
		return redirect()->back()->with('noti_success', 'Chỉnh sửa bài viết thành công!');
  }

  public function deletePost($id){
  	$post = Posts::findOrFail($id);
  	$post->delete();
  	return redirect()->back()->with('noti_success', 'Xóa bài viết thành công!');
  }
}
