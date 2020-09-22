<?php
namespace App\Http\Controllers\Auth;
//namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|string|email|unique:users',
            'password'  => 'required|string|confirmed'
        ]);
        $user = new User([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password)
        ]);
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email'      => 'required|string',
            'password'   => 'required|string',
        ]);
        $credential = request(['email','password']);
        if(!Auth::attempt($credential)){
            return response()->json([
                'message'=>'invalid mail or password'
            ],401);
        }
        $user = $request->user();
        $token = $user->createToken('Access Token');
        $user->access_token = $token->accessToken;

        return response()->json($user,200);
        
    }
    public function logout(Request $request)
    {
        
        $request->user()->token()->revoke();
        

        return response()->json(['message'=>'user logout successfully'],204);
    }
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
