<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'comment' => 'required'
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

        $comment = new Comment([
            'comments' => $request->comment,
            'post_id' => $request->post_id,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);
        $comment->save();

        return response()->json([
            'message' => 'The comment successfully added',
            'data' => $comment
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    public function findCommentByPost($id)
    {
        $comment = Comment::orderBy('created_at','desc')
        ->where('post_id',$id)
        ->get();

        return response()->json([
            'data' => CommentResource::collection($comment)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[ 
            'comment' => 'required'
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

        $comment = Comment::find($id);
        $comment->comments = $request->comment;
        $comment->updated_by = Auth::user()->id;
        $comment->save();

        return response()->json([
            'message' => 'The comment successfully updated',
            'data' => $comment
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();

        return response()->json([
            'message' => 'The comment successfully deleted',
            'data' => $comment
        ]);
    }
}
