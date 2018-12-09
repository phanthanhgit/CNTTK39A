<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\ChangePassRequest;
use App\Users;
use App\Posts;
use App\Tags;
use DateTime;

class UserController extends Controller
{
  public function getProfile($username) {
		$users = Users::select()->where('username', $username)->limit(1)->get()->toArray();
		$id = -1;
		if(count($users) > 0)
			$id = $users[0]['id'];
  	$user = Users::findOrFail($id);
		$posts = Posts::join('users', 'users.id', '=', 'posts.user_id')->select('posts.*', 'users.username', 'users.avatar')->where('posts.user_id', '=', $id)->orderBy('created_at', 'desc')->paginate(20);
		return view('page.user.profile', ['user' => $user, 'posts' => $posts]);
	}

	public function updateProfile($username, UpdateUserRequest $request) {
		if($username == Auth::User()->username) {
			$users = Users::select()->where('username', $username)->limit(1)->get()->toArray();
			$id = -1;
			if(count($users) > 0)
				$id = $users[0]['id'];
	  	$user = Users::findOrFail($id);
	  	$user->fullname = $request->txtfullname;
	  	$user->save();
	  	return redirect()->back()->with('noti_success', 'Cập nhật thông tin thành công!');
		}
		
  	return redirect()->route('home');
	}

	public function getChangePass(){
		return view('page.user.changepass');
	}
	public function postChangePass(ChangePassRequest $request) {
		$user = Users::findOrFail(Auth::User()->id);
		$user->password = bcrypt($request->txtpassword);
		$user->save();
		return redirect()->route('getprofile', ['username' => Auth::User()->username]);
	}
}
