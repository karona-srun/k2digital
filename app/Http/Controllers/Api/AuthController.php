<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private $accessToken;
    public function __construct()
    {
        $this->accessToken = uniqid(base64_encode(Str::random(80)));
    }

    public function signin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['access_token'] = $this->accessToken;
            $success['name'] =  $user->name;
            return response()->json([
                'status' => 'success',
                'data' => $success
            ]);
        } else {
            return response()->json([
                'status' => 'Error',
                'data' => 'Unauthorized Access'
            ]);
        }
    }

    /** 
     * Register API 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        $postArray = $request->all();

        $postArray['password'] = bcrypt($postArray['password']);
        $postArray['access_token'] = $this->accessToken;
        $user = User::create($postArray);

        $success['access_token'] = $user->access_token;
        $success['name'] =  $user->name;
        return response()->json([
            'status' => 'Success',
            'data' => $success,
        ]);
    }
}
