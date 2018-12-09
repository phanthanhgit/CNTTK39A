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

class NotiController extends Controller
{
  public function getAll(){
  	$noti = Noti::select()->where('to_user', Auth::User()->id)->orderBy('created_at', 'desc')->paginate(20);
  	return view('page.noti.noti', ['noti' => $noti]);
  }

  public function delAllNoti(){
  	$notei = Noti::where('to_user', Auth::User()->id)->delete();
  	return redirect()->back()->with('noti_success', 'Đã xóa toàn bộ thông báo!');
  }
}
