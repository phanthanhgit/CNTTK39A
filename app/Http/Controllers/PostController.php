<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UserPostRequest;
use App\Users;
use App\Posts;
use App\Tags;
use DateTime;
use App\Noti;
use App\Comments;
use App\VotePost;

class PostController extends Controller
{

	//Member
	public function showAllPost(){
		$posts = Posts::join('users', 'users.id', '=', 'posts.user_id')->select('posts.*', 'users.username', 'users.avatar')->where('type', 'post')->orderBy('created_at', 'desc')->paginate(20);
		return view('page.post.index', ['posts' => $posts]);
	}
	public function showAllQA(){
		$posts = Posts::join('users', 'users.id', '=', 'posts.user_id')->select('posts.*', 'users.username', 'users.avatar')->where('type', 'question')->orderBy('created_at', 'desc')->paginate(20);
		return view('page.post.index', ['posts' => $posts]);
	}
	public function newPost(){
		return view('page.post.newpost');
	}
	public function postNewPost(UserPostRequest $request){
		$post = new Posts;
		$post->user_id = Auth::User()->id;
		$post->title = $request->txttitle;
		$post->content = $request->txtcontent;
		$post->slug = str_slug($request->txttitle);
		$post->type = 'post';
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
		return redirect()->route('editpost', ['id' => $post->id])->with('noti_success', 'Thêm bài viết thành công!');
	}
	public function newQA(){
		return view('page.post.newpost');
	}
	public function postNewQA(UserPostRequest $request){
		$post = new Posts;
		$post->user_id = Auth::User()->id;
		$post->title = $request->txttitle;
		$post->content = $request->txtcontent;
		$post->slug = str_slug($request->txttitle);
		$post->type = 'question';
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
		return redirect()->route('editpost', ['id' => $post->id])->with('noti_success', 'Thêm bài viết thành công!');
	}

	public function showPost($slug, $id){
		if(isset($_GET['noti'])){
			$noti = Noti::findOrFail($_GET['noti']);
			$noti->status = 0;
			$noti->save();
		}
		$post = Posts::findOrFail($id);
		$post->view = $post->view + 1;
		$post->save();
		$user = Users::findOrFail($post->user_id);
		$cmt = Comments::join('users', 'users.id', '=', 'comments.user_id')->select('comments.*', 'users.username as username', 'users.avatar')->where('post_id', $id)->orderBy('created_at', 'asc')->paginate(50);
		$voted = 0;
		if(Auth::check()){
			$voted = VotePost::where([['post_id', '=', $id], ['user_id', '=', Auth::User()->id]])->count();
		}
		return view('page.post.showpost', ['post' => $post, 'cmt' => $cmt, 'user' => $user, 'voted' => $voted]);
	}

	public function getEditPost($id){
		$post = Posts::findOrFail($id);
		return view('page.post.editpost',['post' => $post]);
	}
	public function postEditPost($id, UserPostRequest $request){
		$post = Posts::findOrFail($id);
		$post->user_id = Auth::User()->id;
		$post->title = $request->txttitle;
		$post->content = $request->txtcontent;
		$post->slug = str_slug($request->txttitle);
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
		return redirect()->back()->with('noti_success', 'Cập nhật bài viết thành công!');
	}
	public function	deletePost($id){
		$post = Posts::findOrFail($id);
		if(Auth::User()->id == $post->user_id || Auth::User()->level < 3){
			$post->delete();
			return redirect()->route('getprofile', ['username' => Auth::User()->username]);
		} else return redirect()->back();
	}

	public function search(){
		if(isset($_GET['key']))
			$key = $_GET['key'];
		else 
			$key = "";
		$posts = Posts::join('users', 'users.id', '=', 'posts.user_id')->select('posts.*', 'users.username', 'users.avatar')->where('title', 'like', '%'.$key.'%')->orWhere('content', 'like', '%'.$key.'%')->orWhere('tags', 'like', '%'.$key.'%')->orderBy('created_at', 'desc')->paginate(20);
		return view('page.post.search', ['posts' => $posts, 'key' => $key]);
	}

	public function postOfUser($username) {
		$posts = [];
		$users = Users::select()->where('username', $username)->limit(1)->get()->toArray();
		$id = -1;
		if(count($users) > 0)
			$id = $users[0]['id'];
  	$user = Users::findOrFail($id);
		$posts = Posts::join('users', 'users.id', '=', 'posts.user_id')->select('posts.*', 'users.username', 'users.avatar')->where('posts.user_id', '=', $id)->orderBy('created_at', 'desc')->paginate(10);
		return view('page.user.posts', ['username' => $username, 'posts' => $posts]);
	}

	public function vote_post($id) {
		if(!Auth::check()){
			echo 'login';
		} else {
			$count_vote = VotePost::where([['post_id', '=', $id], ['user_id', '=', Auth::User()->id]])->count();
			if($count_vote > 0) {
				echo 'voted';
			} else {
				$vote = new VotePost;
				$vote->user_id = Auth::User()->id;
				$vote->post_id = $id;
				$vote->save();
				$post = Posts::findOrFail($id);
				$post->count_vote = $post->count_vote + 1;
				$post->save();
				$noti = new Noti;
				$noti->to_user = $post->user_id;
				$noti->save();
				$str = "<a class='text-dark' href='".route('showpost', ['slug' => $post->slug, 'id' => $post->id])."?noti=".$noti->id."'><b>".Auth::User()->username."</b> đã vote bài viết của bạn </a><br><p class='text-secondary m-0' style='font-size: 14px;'><i class='fas fa-user-clock'></i> ".$vote->created_at."</p>";
				$noti->content = $str;
				$noti->save();
				echo 'success';
			}
		}
	}
}
