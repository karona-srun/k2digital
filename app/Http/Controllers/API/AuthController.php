<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class AuthController extends Controller
{
    public function signin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()],200);
        }

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials))
            return response()->json([
                'status' => 'error',
                'message' => 'The provided credentials are incorrect!'
            ], 200);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $user['access_token'] = $tokenResult->accessToken;
        $user->save();

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json([
            'status' => 'success',
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    /** 
     * Register API 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'avatar' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = User::where('email',$request->email)->first();
        if($email){
            return response()->json([
                'status' => 'error',
                'error' => 'Email is already taken'],200);
        }

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->role = 2; // user normal
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        
        if ($request->hasFile('avatar')) {
            $avatar      = $request->file('avatar');
            $fileName   = time() .'_'. $avatar->getClientOriginalName();
            $img = Image::make($avatar->getRealPath());
        }else{
            $fileName   = time() .'_'. $request->first_name.'_'.$request->last_name.'.png';
            $avatar = "https://ui-avatars.com/api/?background=random&size=200&name=".$request->first_name.'+'.$request->last_name;
            $img = Image::make($avatar);
        }
        $img->fit(200, 200, function ($constraint) {
            $constraint->upsize();                 
        });
        $img->stream();
        Storage::disk('local')->put('public/avatars/'.$fileName, $img, 'public');
        
        $user->avatar = $fileName;
        $user->save();

        return response()->json([
            'status' => 'success',
            'data' => $user,
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function me()
    {
        $user = auth()->user();
        $user->petools;
        $user->plans;
        $user['has_plans'] = empty($user->plans) ?? true;
        $user['has_petools'] = empty($user->hasPetools) ?? true;
        $user['avatar'] = url(Storage::url("avatars/".$user->avatar));
        return response()->json([ 'data' => $user]);
    }

    public function signout(Request $request)
    {
        $user = $request->user();
        $user['access_token'] = '';
        $user->save();
        $request->user()->token()->revoke();
        return response()->json([
            'status' => 'success',
            'message' => 'successful-logout'
        ]);
    }

    public function deleteFile($path){
        if(file_exists(public_path($path))){
            try{
                unlink(public_path($path));
            }catch(\Exception $e){
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
    }
}
