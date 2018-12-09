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
use App\Http\Requests\TagRequest;
use App\Users;
use App\Posts;
use App\Tags;
use DateTime;
use Avatar;

class TagController extends Controller
{

  public function getIndex(){
  	$key = "";
  	if(isset($_GET['key'])){
  		$key = $_GET['key'];
  	}
  	$tag = Tags::select('*')->where('name', 'like', '%'.$key.'%')->orderBy('created_at', 'desc')->paginate(20);
  	return view('admin.tag.index', ['tags' => $tag]);;
  }

  public function addTag(){
  	return view('admin.tag.add');
  }

  public function postAddTag(TagRequest $request){
  	$slug = str_slug(trim($request->txttag));
		$tag = Tags::where('slug', '=', $slug)->count();
		if($tag <= 0) {
			$tag = new Tags;
			$tag->name = trim($request->txttag);
			$tag->slug = $slug;
			$tag->save();
			return redirect()->route('detailtag', ['id' => $tag->id])->with('noti_success', 'Thêm thẻ thành công!');
		} else {
			return redirect()->back()->with('noti_fail', 'Đã có thẻ tương tự tồn tại!');
		}
  }

  public function editTag($id){
  	$tag = Tags::findOrFail($id);
  	return view('admin.tag.edit', ['tag' => $tag]);
  }

  public function postEditTag($id, TagRequest $request){
  	$tag = Tags::findOrFail($id);
  	$slug = str_slug(trim($request->txttag));
		$count = Tags::where('slug', '=', $slug)->count();
		if($count <= 0) {
			$tag->name = trim($request->txttag);
			$tag->slug = $slug;
			$tag->save();
			return redirect()->back()->with('noti_success', 'Cập nhật thẻ thành công!');
		} else if($tag->slug == $slug){
			return redirect()->back()->with('noti_success', 'Cập nhật thẻ thành công!');
		} else {
			return redirect()->back()->with('noti_fail', 'Đã có thẻ tương tự tồn tại!');
		}
  }

  public function deleteTag($id) {
  	$tag = Tags::findOrFail($id);
  	$tag->delete();
  	return redirect()->back()->with('noti_success', 'Xóa thẻ thành công!');
  }	
}
