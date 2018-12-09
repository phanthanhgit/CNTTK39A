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
use App\Http\Requests\CommentRequest;
use App\Users;
use App\Posts;
use App\Tags;
use DateTime;
use Avatar;
use App\Comments;

class CommentController extends Controller
{
	public function getIndex() {
		$key = "";
		if(isset($_GET['key']))
			$key = $_GET['key'];
		$cmt = Comments::join('users', 'comments.user_id', '=', 'users.id')->join('posts', 'comments.post_id', '=', 'posts.id')->select('comments.*', 'users.username', 'posts.title', 'posts.id as postid', 'posts.slug')->where('comments.content', 'like', '%'.$key.'%')->orWhere('users.username', 'like', '%'.$key.'%')->orWhere('posts.title', 'like', '%'.$key.'%')->orWhere('posts.content', 'like', '%'.$key.'%')->orWhere('posts.tags', 'like', '%'.$key.'%')->orderBy('created_at', 'desc')->paginate(15);
			return view('admin.comments.index', ['cmts' => $cmt]);
	}

	public function editCmt($id) {
		$cmt = Comments::findOrFail($id);
		$post = Posts::findOrFail($cmt->post_id);
		return view('admin.comments.edit', ['cmt' => $cmt, 'post' => $post]);
	}

	public function postEditCmt($id, CommentRequest $request) {
		$cmt = Comments::findOrFail($id);
		$cmt->content = $request->txtcontent;
		$cmt->save();
		return redirect()->back()->with('noti_success', 'Cập nhật bình luận thành công!');	
	}

	public function deleteCmt($id) {
		$cmt = Comments::findOrFail($id);
		$cmt->delete();
		return redirect()->route('allcmt')->with('noti_success', 'Xóa bình luận thành công!');
	}
}
