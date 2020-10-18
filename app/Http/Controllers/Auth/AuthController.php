<?php
namespace App\Http\Controllers\Auth;
//namespace App\Http\Controllers\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\LinkedSocialAccount;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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
    public function redirectToProvider($website){
        return Socialite::driver($website)->redirect();
    }
    public function handlerProviderCallback($website)
    {
        $user = Socialite::driver($website)->stateless()->user();
        if(!$user->token){
            return response()->json(['message'=>'error in login']);
        }
        $appUser = user::where('users.email','=',$user->email)
                        ->first();
        if(!$appUser){
            $newUser = user::create([
                'name'      =>  $user->name,
                'email'     =>  $user->email,
                'password'  =>  Hash::make(Str::random(12))
            ]);
            $appUser = user::where('users.email','=',$user->email)
                        ->first();
            $socialAccount = LinkedSocialAccount::create([
                'provider_name' =>  $website,
                'provider_id'   =>  $user->id, 
                'user_id'       =>  $appUser->id
            ]);

        }else{
            $socialAccount = \DB::table('users')
                        ->select('users.id','users.name','users.email','linked_social_accounts.provider_id','linked_social_accounts.provider_name')
                        ->join('linked_social_accounts','user_id','=','users.id')
                        ->where('users.email','=',$user->email)
                        ->first();
            if(!$socialAccount){
                $socialAccount = LinkedSocialAccount::create([
                    'provider_name' =>  $website,
                    'provider_id'   =>  $user->id, 
                    'user_id'       =>  $appUser->id
                ]);
            }
        }
        $token = $appUser->createToken('Access Token')->accessToken;
        return response()->json(['access_token'=>$token]);
    }
}
