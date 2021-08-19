<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
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

Route::post('sign-in', [App\Http\Controllers\API\AuthController::class, 'signin'])->name('sign-in');
Route::post('sign-up', [App\Http\Controllers\API\AuthController::class, 'signup'])->name('sign-up');


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



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
