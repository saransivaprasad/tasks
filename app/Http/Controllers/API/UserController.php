<?php

namespace App\Http\Controllers\API;

use App\User;
use Hash;
use Validator;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'  => 'required|email',
            'password'  => 'required|string',
        ]);
        if ($validator->fails()) {
            $data = (object) [];
            return response()->json(['message' => 'Email and password are required for login.', 'data' => $data]);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $data = (object) [];
            return response()->json(['message' => 'You are not authorised to access this application. Please contact the administrator.', 'data' => $data]);
        }
        if ($user && Hash::check(request('password'), $user->password)) {
            $objToken = $user->createToken('Tasks');
            $strToken = $objToken->accessToken;
            $expiration = $objToken->token->expires_at->diffInSeconds(Carbon::now());
            $data['user_id'] =  $user->id;
            $data['token'] =  $strToken;
            $data['token_type'] = 'Bearer';
            $data['expires_in'] = $expiration;
            return response()->json(['code' => 200, 'message' => 'Successful', 'data' => $data]);
        } else {
            $data = (object) [];
            return response()->json(['code' => 401, 'message' => 'You have entered an invalid username or password. Please try again.', 'data' => $data], 200);
        }
    }
}
