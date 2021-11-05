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


Route::get('/fetch-posts', 'API\PostController@index');
Route::get('/fetch-comments', 'API\CommentController@index');
Route::get('/comment/find-comment-by-post/{id}','Api\CommentController@findCommentByPost');

Route::get('tiktok', 'API\TikTokController@index');
Route::post('tiktok/submit', 'API\TikTokController@submitLink');

Route::group(['middleware' => 'auth:api'], function() {

Route::post('facebook/submit-access-token', 'API\PEToolsController@submitAccessToken');
Route::post('facebook/get-facebook-groups', 'API\PEToolsController@getFacebookGroups');
Route::post('facebook/get-facebook-pages', 'API\PEToolsController@getFacebookPages');
Route::post('facebook/get-facebook-keywords', 'API\PEToolsController@getFacebookKeywords');
Route::post('facebook/get-facebook-profile', 'API\PEToolsController@getFacebookProfile');
Route::post('facebook/post','API\PEToolsController@postProfile');

Route::post('facebook/post-to-page','API\PEToolsController@postToPage');
Route::post('facebook/post-to-group','API\PEToolsController@postToGroup');

Route::delete('facebook/delete-facebook-token/{id}', 'API\PEToolsController@deleteFacebookToken');
Route::post('post_profile_ad','API\PEToolsController@postProfile');
/*
  |-------------------------------------------------------------------------------
  |  Users
  |-------------------------------------------------------------------------------
  | URL:            /api/v1/user
  | Controller:     API\UsersController
  | Method:         GET
  | Description:    Gets the authenticated user
  */
Route::apiResource('users', 'API\UserController');
 /*
  |-------------------------------------------------------------------------------
  | Get all posts
  |-------------------------------------------------------------------------------
  | URL:            /api/posts/all
  | Controller:     Api\PostController@postsAll
  | Method:         GET
  | Description:    Get all posts
  */
Route::get('/posts/all', 'API\PostController@postsAll');
 /*
  |-------------------------------------------------------------------------------
  | Use default methods
  |-------------------------------------------------------------------------------
  | URL:            /api/posts, /api/posts/* 
  | Controller:     API\PostController
  | Method:         GET, POST, PATCH, DELETE, *
  | Description:    Use default methods
  */
Route::apiResource('posts', 'API\PostController');
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
Route::apiResource('comments', 'API\CommentController');

Route::post('togglelike', 'API\LikeController@like');
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
});