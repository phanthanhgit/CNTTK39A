<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Users;
use App\Posts;
use App\Tags;
use DateTime;

class TagsController extends Controller
{
	public function showPostOfTag($slug){
		$tag = Tags::select('*')->where('slug', $slug)->limit(1)->get();
		if(count($tag) > 0) {
			$posts = Posts::join('users', 'users.id', '=', 'posts.user_id')->select('posts.*', 'users.username', 'users.avatar')->where('tags', 'like', '%'.$tag[0]->name.'%')->orderBy('created_at', 'desc')->paginate(20);
			return view('page.tag.tagpost', ['posts' => $posts, 'tag' => $slug]);
		}
	}

	public function getAllTag(){
		$tags = Tags::select('*')->paginate(50);
		return view('page.tag.alltag', ['tags' => $tags]);
	}
}
