<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Users;
use App\Posts;
use App\Tags;

Route::get('/', function () {
		$posts = Posts::join('users', 'users.id', '=', 'posts.user_id')->select('posts.*', 'users.username', 'users.avatar')->where('type', 'post')->orderBy('created_at', 'desc')->paginate(10);
		$qas = Posts::join('users', 'users.id', '=', 'posts.user_id')->select('posts.*', 'users.username', 'users.avatar')->where('type', 'question')->orderBy('created_at', 'desc')->paginate(10);
    return view('page.home', ['posts' => $posts, 'qas' => $qas]);
})->name('home');

Route::get('dang-nhap', ['as' => 'dangnhap', 'uses' => 'LoginController@getLogin']);
Route::post('dang-nhap', ['as' => 'postdangnhap', 'uses' => 'LoginController@postLogin']);

Route::get('login', ['as' => 'login', 'uses' => 'LoginController@getLogin']);
Route::post('login', ['as' => 'postlogin', 'uses' => 'LoginController@postLogin']);

Route::get('dang-ky', ['as' => 'dangky', 'uses' => 'RegisterController@getRegis']);
Route::post('dang-ky', ['as' => 'postdangky', 'uses' => 'RegisterController@postRegis']);

Route::get('dang-xuat', ['as' => 'dangxuat', 'uses' => 'LoginController@getLogout']);

Route::group(['middleware' => 'auth'], function () {
	Route::get('dang-bai', ['as' => 'dangbai', 'uses' => 'PostController@newPost']);
	Route::post('dang-bai', ['as' => 'postdangbai', 'uses' => 'PostController@postNewPost']);
	Route::get('dat-cau-hoi', ['as' => 'datcauhoi', 'uses' => 'PostController@newQA']);
	Route::post('dat-cau-hoi', ['as' => 'postdatcauhoi', 'uses' => 'PostController@postNewQA']);
	//Profile
	Route::get('change-password', ['as' => 'changepass', 'uses' => 'UserController@getChangePass']);
	Route::post('change-password', ['as' => 'postchangepass', 'uses' => 'UserController@postChangePass']);

	//Comment 
	Route::post('commentto/{id}', ['as' => 'postcmt', 'uses' => 'CommentController@postCmt']);
	Route::get('delcmt/{id}', ['as' => 'delcmt', 'uses' => 'CommentController@delCmt']);

	//Noti
	Route::get('thong-bao', ['as' => 'allnoti', 'uses' => 'NotiController@getAll']);
	Route::get('delete-all-noti', ['as' => 'delallnoti', 'uses' => 'NotiController@delAllNoti']);
});

Route::group(['prefix' => 'bai-viet'], function() {
	Route::get('/', ['as' => 'showallpost', 'uses' => 'PostController@showAllPost']);
	Route::get('/{slug}.{id}', ['as' => 'showpost', 'uses' => 'PostController@showPost']);
	Route::group(['middleware' => 'auth'], function() {
		Route::get('/chinh-sua/{id}', ['as' => 'editpost', 'uses' => 'PostController@getEditPost']);
		Route::post('/chinh-sua/{id}', ['as' => 'posteditpost', 'uses' => 'PostController@postEditPost']);
		Route::get('/xoa/{id}', ['as' => 'delpost', 'uses' => 'PostController@deletePost']);
	});
	//Vote
	Route::get('/vote/{id}', ['as' => 'vote', 'uses' => 'PostController@vote_post']);
});
Route::get('cau-hoi', ['as' => 'showallqa', 'uses' => 'PostController@showAllQA']);
Route::get('/search', ['as' => 'search', 'uses' => 'PostController@search']);

Route::group(['prefix' => 'tags'], function(){
	Route::get('/', ['as' => 'showalltag', 'uses' => 'TagsController@getAllTag']);
	Route::get('/{slug}', ['as' => 'showposttag', 'uses' => 'TagsController@showPostOfTag']);
});

Route::get('/{username}/posts', ['as' => 'postofuser', 'uses' => 'PostController@postOfUser']);
Route::group(['prefix' => 'profile'], function(){
	Route::get('/{username}', ['as' => 'getprofile', 'uses' => 'UserController@getProfile']);
	Route::post('/{username}', ['as' => 'updateprofile', 'uses' => 'UserController@updateProfile']);
});


//Admin
Route::group(['middleware' => 'auth'], function(){
	Route::group(['prefix' => 'pt64admin'], function(){
		Route::get('/', ['as' => 'admin', 'uses' => 'Admin\UserController@getDashboard']);

		Route::group(['prefix' => 'users'], function(){
			Route::get('/', ['as' => 'alluser', 'uses' => 'Admin\UserController@getIndex']);
			Route::get('/add', ['as' => 'adduser', 'uses' => 'Admin\UserController@addUser']);
			Route::post('/add', ['as' => 'postadduser', 'uses' => 'Admin\UserController@postAddUser']);
			Route::get('/detail/{id}', ['as' => 'detailuser', 'uses' => 'Admin\UserController@editUser']);
			Route::post('/detail/{id}', ['as' => 'postdetailuser', 'uses' => 'Admin\UserController@postEditUser']);
			Route::get('/delete/{id}', ['as' => 'deluser', 'uses' => 'Admin\UserController@deleteUser']);

			Route::get('/change-password/{id}', ['as' => 'changepassuser', 'uses' => 'Admin\UserController@changePassUser']);
			Route::post('/change-password/{id}', ['as' => 'postchangepassuser', 'uses' => 'Admin\UserController@postChangePassUser']);
		});

		Route::group(['prefix' => 'post'], function(){
			Route::get('/', ['as' => 'allpost', 'uses' => 'Admin\PostController@getIndex']);
			Route::get('/add', ['as' => 'addpost', 'uses' => 'Admin\PostController@addPost']);
			Route::post('/add', ['as' => 'postaddpost', 'uses' => 'Admin\PostController@postAddPost']);
			Route::get('/detail/{id}', ['as' => 'detailpost', 'uses' => 'Admin\PostController@editPost']);
			Route::post('/detail/{id}', ['as' => 'postdetailpost', 'uses' => 'Admin\PostController@postEditPost']);
			Route::get('/delete/{id}', ['as' => 'delpost', 'uses' => 'Admin\PostController@deletePost']);
		});

		Route::group(['prefix' => 'tags'], function(){
			Route::get('/', ['as' => 'alltag', 'uses' => 'Admin\TagController@getIndex']);
			Route::get('/add', ['as' => 'addtag', 'uses' => 'Admin\TagController@addTag']);
			Route::post('/add', ['as' => 'postaddtag', 'uses' => 'Admin\TagController@postAddTag']);
			Route::get('/detail/{id}', ['as' => 'detailtag', 'uses' => 'Admin\TagController@editTag']);
			Route::post('/detail/{id}', ['as' => 'postdetailtag', 'uses' => 'Admin\TagController@postEditTag']);
			Route::get('/delete/{id}', ['as' => 'deltag', 'uses' => 'Admin\TagController@deleteTag']);
		});

		Route::group(['prefix' => 'comments'], function(){
			Route::get('/', ['as' => 'allcmt', 'uses' => 'Admin\CommentController@getIndex']);
			Route::get('/detail/{id}', ['as' => 'detailcmt', 'uses' => 'Admin\CommentController@editCmt']);
			Route::post('/detail/{id}', ['as' => 'postdetailcmt', 'uses' => 'Admin\CommentController@postEditCmt']);
			Route::get('/delete/{id}', ['as' => 'delcmt', 'uses' => 'Admin\CommentController@deleteCmt']);
		});
	});
});