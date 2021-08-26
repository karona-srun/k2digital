<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    public function like(Request $request)
    {

        $like = Like::where(['post_id' => $request->post_id,'created_by' => Auth::user()->id ])->first();
        if($like){
            $like->like = $like->like == 1 ? 0 : 1;
        }
        else{
            $like = new Like([
                'like' => 1,
                'post_id' => $request->post_id,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
        if($like->save()){
            $data = [
                'message' => 'Like is already created',
                'data' => $like
            ];
        }else{
            $data = [
                'message' => 'Like is error'
            ];
        }
        return response()->json($data);
    }
}
