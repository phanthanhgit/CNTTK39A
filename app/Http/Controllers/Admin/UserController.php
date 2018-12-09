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
use App\Users;
use App\Posts;
use App\Tags;
use DateTime;
use Avatar;

class UserController extends Controller
{
	public function getDashboard(){
		if(Auth::User()->level < 3) {
			$tags = Tags::all()->count();
			$posts = Posts::select('*')->where('type', 'post')->count();
			$asks = Posts::select('*')->where('type', 'question')->count();
			$users = Users::all()->count();
			return view('admin.dashboard', ['tags' => $tags, 'posts' => $posts, 'asks' => $asks, 'users' => $users]);
		} else 
			return redirect()->route('home');
	}

	public function getIndex(){
		if(Auth::User()->level != 1)
			return redirect()->route('admin');
		$key = "";
		if(isset($_GET['key'])){
			$key = $_GET['key'];
		}
		$users = Users::select('*')->where('username', 'like', '%'.$key.'%')->orWhere('email', 'like', '%'.$key.'%')->orWhere('fullname', 'like', '%'.$key.'%')->orderBy('created_at', 'desc')->paginate(10);
		return view('admin.user.index', ['users' => $users]);
	}

	public function addUser(){
		if(Auth::User()->level != 1)
			return redirect()->route('admin');
		return view('admin.user.add');
	}

	public function postAddUser(RegisterRequest $request){
		if(Auth::User()->level != 1)
			return redirect()->route('admin');
		$user = new Users;
		$user->username = $request->txtusername;
		$user->email = $request->txtemail;
		$user->fullname = $request->txtfullname;
		$user->password = bcrypt($request->txtpassword);
    $user->avatar = Avatar::create($request->txtusername)
                    ->setDimension(500, 500)
                    ->setFontSize(300)
                    ->setShape('square')
                    ->toBase64();
    $user->level = $request->txtlevel;
  	$user->save();
  	return redirect()->route('alluser')->with('noti_success', 'Thêm tài khoản thành công!');
	}

	public function editUser($id){
		if(Auth::User()->level != 1)
			return redirect()->route('admin');
		$user = Users::findOrFail($id);
		return view('admin.user.edit', ['user' => $user]);
	}

	public function postEditUser($id, UpdateUserRequest $request){
		if(Auth::User()->level != 1)
			return redirect()->route('admin');
		$user = Users::findOrFail($id);
		$user->username = $request->txtusername;
		$user->email = $request->txtemail;
		$user->fullname = $request->txtfullname;
		$user->level = $request->txtlevel;
  	$user->save();
  	return redirect()->back()->with('noti_success', 'Cập nhật thông tin tài khoản thành công!');
	}

	public function changePassUser($id){
		if(Auth::User()->level != 1)
			return redirect()->route('admin');
		return view('admin.user.changepass', ['id' => $id]);
	}

	public function postChangePassUser($id, ChangePassRequest $request){
		if(Auth::User()->level != 1)
			return redirect()->route('admin');
		$user = Users::findOrFail($id);
		$user->password = bcrypt($request->txtpassword);
		$user->save();
		return redirect()->route('detailuser',['id' => $id])->with('noti_success', 'Cập nhật mật khẩu tài khoản thành công!');
	}

	public function deleteUser($id){
		if(Auth::User()->level != 1)
			return redirect()->route('admin');
		$user = Users::findOrFail($id);
		$user->delete();
		return redirect()->back()->with('noti_success', 'Xóa tài khoản thành công!');
	}
}
