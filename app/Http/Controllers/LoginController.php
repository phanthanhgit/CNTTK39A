<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
  public function getLogin() {
	if (!Auth::check()){
      return view('page.login');
    } else {
      return redirect()->back();
    }
  }

  public function postLogin(LoginRequest $request){
  	$login =  [
      'email' => $request->txtemail,
      'password' => $request->txtpassword
    ];
    if (Auth::attempt($login)) { 
      return redirect()->route('home');
    } else {
      return redirect('dang-nhap')->with('error_login', 'Tên đăng nhập hoặc mật khẩu sai');
    }
  }

  public function getLogout(){
  	Auth::logout();
  	return redirect()->route('home');
  }
}
