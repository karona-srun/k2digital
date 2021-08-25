<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function() {
Route::post('sign-in', [AuthController::class, 'signin']);
Route::post('sign-up', [AuthController::class, 'signup']);
  Route::group(['middleware' => 'auth:api'], function() {
    Route::get('me', [AuthController::class,'me']);
    Route::post('sign-out', [AuthController::class, 'signout']);
  });
});


Route::get('/fetch-posts', [PostController::class, 'index']);
Route::get('/fetch-comments', [CommentController::class, 'index']);
Route::get('/comment/find-comment-by-post/{id}','Api\CommentController@findCommentByPost');

Route::group(['middleware' => 'auth:api'], function() {
/*
  |-------------------------------------------------------------------------------
  |  Users
  |-------------------------------------------------------------------------------
  | URL:            /api/v1/user
  | Controller:     API\UsersController
  | Method:         GET
  | Description:    Gets the authenticated user
  */
Route::resource('users', 'Api\UserController');
 /*
  |-------------------------------------------------------------------------------
  | Get all posts
  |-------------------------------------------------------------------------------
  | URL:            /api/posts/all
  | Controller:     Api\PostController@postsAll
  | Method:         GET
  | Description:    Get all posts
  */
Route::get('/posts/all', 'Api\PostController@postsAll');
 /*
  |-------------------------------------------------------------------------------
  | Use default methods
  |-------------------------------------------------------------------------------
  | URL:            /api/posts, /api/posts/* 
  | Controller:     API\PostController
  | Method:         GET, POST, PATCH, DELETE, *
  | Description:    Use default methods
  */
Route::resource('posts', 'Api\PostController');
/*
  |-------------------------------------------------------------------------------
  | Use default methods
  |-------------------------------------------------------------------------------
  | URL:            /api/comments, /api/comments/* 
  | Controller:     API\CommentController
  | Method:         GET, POST, PATCH, DELETE, *
  | Description:    Use default methods
  */
Route::get('/comments/find-comment-by-post/{id}','Api\CommentController@findCommentByPost');
Route::resource('comments', 'Api\CommentController');



// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
});