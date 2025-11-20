<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\TUser;
use Exception;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
class GoogleAuthController extends Controller
{
    public function loginWithGoogle(){

        $url = Socialite::driver('google')->redirect() ->getTargetUrl();
        return "yahya";
        return response()->json([
            'url' => $url,
        ],200);
    }
    public function callbackFromGoogle(){
        $user = Socialite::driver('google')->user();
        dd($user);
        $is_user = TUser::where('s_email', $user->getEmail())->first();
        try{
            if (!$is_user) {
                $saveUser = TUser::create([
                    's_name' => $user->getName(),
                    's_email' => $user->getEmail(),
                    's_password' => $user->getName() . '$' . $user->getId(),
                ]);
                $token = $saveUser->createToken('register');
                $saveUser['s_access_token'] = $token->plainTextToken;
                return response()->json([
                    'message' => 'login Successfully',
                    'user' => $saveUser
                ]);
            } else {
                $saveUser = TUser::where('s_email', $user->getEmail())->first();
                $token = $saveUser->createToken('register');
                $saveUser['s_access_token'] = $token->plainTextToken;
                return response()->json([
                    'message' => 'login Successfully',
                    'user' => $saveUser
                ]);
            }
        }catch(Exception $e){
            return \response()->json([
                'code' => $e->getCode(),
                'message' => 'error'
            ]);
        }
    }
}
