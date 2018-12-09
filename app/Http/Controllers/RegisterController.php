<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\RegisterRequest;
use App\Users;
use App\User;
use DateTime;
use Avatar;

class RegisterController extends Controller
{
  public function getRegis(){
  	if(Auth::check())
  		return redirect()->route('home');
  	else 
  		return view('page.register');
  }

  public function postRegis(RegisterRequest $request){
  	$user = new User;
  	$user->username = $request->txtusername;
  	$user->email = $request->txtemail;
  	$user->password = bcrypt($request->txtpassword);
    $user->avatar = Avatar::create($request->txtusername)
                    ->setDimension(500, 500)
                    ->setFontSize(300)
                    ->setShape('square')
                    ->toBase64();
  	$user->save();
  	return redirect()->route('dangnhap');
  }
}
