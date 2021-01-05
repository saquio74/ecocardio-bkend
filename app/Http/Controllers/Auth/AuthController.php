<?php
namespace App\Http\Controllers\Auth;
//namespace App\Http\Controllers\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\LinkedSocialAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;


class AuthController extends Controller
{
    public function signup(Request $request)
    {
            
            $request->validate([
                'name'      => 'required|string',
                'email'     => 'required|string|email|unique:users',
                'password'  => 'required|string|confirmed',
            ]);
            $user = new User([
                'name'          => $request->name,
                'email'         => $request->email,
                'mp'            => $request->mp,
                'mn'            => $request->mn,
                'especialidad'  => $request->especialidad,
                'password'      => bcrypt($request->password)
            ]);
            
            $email = $user->email;
            $user->save();
            $user = User::where('email',$email)->first();
            
            $messageData = [
                'id'=>$user->id,
                'name'=>$user->name,
                'email'=>$user->email, 
                'code'=>base64_encode($email)
            ];
            
            Mail::send('emails.emailConfirm',$messageData, function($message)use($email){
                $message->to($email)->subject('Confirma tu cuenta por favor');
            });
            $user->save();
            return response()->json([
                'message' => 'Por favor confirma tu e-mail!'
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
        $url = Socialite::driver($website)->redirect()->getTargetUrl();
        return response()->json(['url'=> $url]);
    }
    
    public function verify($id,$code){
        //dd($code);
        $user = User::where('id','=',$id)->first();
        if($user->email == \base64_decode($code)){
            if($user->email_verified_at == null){

                $user->email_verified_at = Carbon::now()->toDateTimeString();
                $user->save();
            }
        }
        //User::whereId($id)->update($user->all());
        //dd($user);
        $response = $user->email_verified_at != null ? 'El email ya se encuentra confirmado'
                                                    :($user->email != \base64_decode($code)
                                                    ?'El codigo ingresado no es valido o ha caducado'
                                                    :'usuario verificado correctamente');
        
        return response()->json(['response'=>$response],201);
    }
    public function resend(Request $request){
        //dd($request);
        $user = User::whereId($request->id)->first();
        $email = $user->email;  
        $messageData = [
            'id'=>$user->id,
            'name'=>$user->name,
            'email'=>$user->email, 
            'code'=>base64_encode($email)
        ];
        
        Mail::send('emails.emailConfirm',$messageData, function($message)use($email){
            $message->to($email)->subject('Reenvio de confirmacion de email');
        });
        return response()->json(['message'=>'Mensaje reenviado'],201);
    }
    public function userDataModify(Request $request){
        $request->validate([
            'id'        =>  'required',
            'name'      =>  'required|string',
            'email'     =>  'required|string|email',
            'password'  =>  'required|string|confirmed',
        ]);
        $user = User::whereId($request->id)->first();
        
        $user->name = $request->name;
        $user->especialidad = $request->especialidad;
        $user->mp = $request->mp;
        $user->mn = $request->mn;
        $user->save();
        return response()->json(['message'=>'Datos modificados correctamente'],201);
    }
}
