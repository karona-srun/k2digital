<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('comments')->orderBy('created_at','desc')
        ->where('privacy',1)
        ->get();

    
        return response()->json([
            'data' => $posts
        ]);
    }

    public function postsAll()
    {
        $posts = Post::with('comments')->orderBy('created_at','desc')
        ->get();
        return response()->json([
            'data' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[ 
            'post' => 'required'
        ]);
    
        if($validation->fails()){
            $data = [
                'status' => 'ERROR',
                'error' =>   $validation->errors()
            ];

            return response([
                'data' => $data,
            ], 404);
    
        }  

        $post = new Post([
            'post' => $request->post,
            'privacy' => $request->privacy,
            'likes' => 0,
            'creator' => 1,
            'updator' => 1
        ]);
        $post->save();

        return response()->json([
            'message' => 'The post successfully added',
            'data' => $post
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $post = Post::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            $data = [
                'status' => 'ERROR',
                'error' => 'Post is not found'
            ];
            return response([
                'data' => $data
            ], 404);
        }
        return response()->json([
            'data' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $post = Post::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            $data = [
                'status' => 'ERROR',
                'error' => 'Post is not found'
            ];
            return response([
                'data' => $data
            ], 404);
        }
        return response()->json([
            'data' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->post = $request->post;
            $post->privacy = $request->privacy;
            $post->save();
        } catch (ModelNotFoundException $e) {
            $data = [
                'status' => 'ERROR',
                'error' => 'Post is not found'
            ];
            return response([
                'data' => $data
            ], 404);
        }
        return response()->json([
            'message' => 'The post successfully updated',
            'data' => $post
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return response()->json([
            'message' => 'The post successfully deleted',
            'data' => $post
        ]);
    }
}
