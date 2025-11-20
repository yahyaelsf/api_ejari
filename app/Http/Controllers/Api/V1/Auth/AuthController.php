<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\V1\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Http\Requests\Api\V1\RegisterRequest;
use App\Http\Resources\Api\V1\HomeResource;
use App\Http\Resources\Api\V1\MeResources;
use App\Http\Resources\Api\V1\ProfileResource;
use App\Http\Resources\Api\V1\ShortUserDetialResource;
use App\Http\Resources\Api\V1\UserDetialsResource;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\DeviceToken;
use App\Models\TUser;
use App\Models\TUserDetials;
use App\Notifications\TimeExerciseNotification;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class AuthController extends ApiBaseController
{

    public function register(RegisterRequest $request)
    {

        $user =  TUser::create($request->all());
        $token = $user->createToken('register');
        $user['s_access_token'] = $token->plainTextToken;
        $fcm_token = $request->header('Fcm-Token');
        $user_token = DeviceToken::where('fk_i_user_id',$user->pk_i_id)->where('token',$fcm_token)->first();
        if(!$user_token){
            $device_token = new DeviceToken();
            $device_token->fk_i_user_id = $user->pk_i_id;
            $device_token->token = $fcm_token;
            $device_token->save();
        }
        // $code = random_int(1000, 9999);
        // $user->update(
        //     [
        //         's_verify_code' => 1234,
        //         'sent_code_date' => date('Y-m-d H:i:s'),
        //     ]
        // );

        // Mail::send('emails.verifyEmail', ['code' => $code], function ($message) use ($user) {
        //     $message->to($user->s_email)->subject('Confirm email');
        // });


        return $this->successResponse(__('alerts.successfully_registered'), new UserResource($user),'user');

    }
    // public function login(LoginRequest $request){
    //     $user = TUser::where('s_email', $request->get('s_email'))->orWhere('s_mobile', $request->get('s_mobile'))->first();
    //             return Hash::check($request->get('s_password'), $user->s_password);
    //     if (Hash::check($request->get('s_password'), $user->s_password)) {
    //         $token = $user->createToken('login');
    //         $user['s_access_token'] = $token->plainTextToken;
    //         $fcm_token = $request->header('Fcm-Token');
    //         $user_token = DeviceToken::where('fk_i_user_id',$user->pk_i_id)->where('token',$fcm_token)->first();
    //         if(!$user_token){
    //             $device_token = new DeviceToken();
    //             $device_token->fk_i_user_id = $user->pk_i_id;
    //             $device_token->token = $fcm_token;
    //             $device_token->save();
    //         }
    //         return $this->setSuccess(__('alerts.successfully_logged_in'))
    //         ->addResource(new UserResource($user), 'user')->getResponse();
    //     } else {
    //         return $this->failResponse(__('alerts.failed_to_login'));
    //     }
    // }
        public function login(LoginRequest $request){
        $user = TUser::where('s_email', $request->get('s_email'))->orWhere('s_mobile', $request->get('s_mobile'))->first();
        $credentials = [
            's_mobile' => $request->s_mobile,
            'password' => $request->s_password
        ];
        // Hash::check($request->s_password, $user->s_password)
        if (Auth::attempt($credentials)) {
            $token = $user->createToken('login');
            $user['s_access_token'] = $token->plainTextToken;
            $fcm_token = $request->header('Fcm-Token');
            $user_token = DeviceToken::where('fk_i_user_id',$user->pk_i_id)->where('token',$fcm_token)->first();
            if(!$user_token){
                $device_token = new DeviceToken();
                $device_token->fk_i_user_id = $user->pk_i_id;
                $device_token->token = $fcm_token;
                $device_token->save();
            }
            return $this->setSuccess(__('alerts.successfully_logged_in'))
            ->addResource(new UserResource($user), 'user')->getResponse();
        } else {
            return $this->failResponse(__('alerts.failed_to_login'));
        }
    }

    public function logout()
    {
        $currentAccessToken = auth()->user()->currentAccessToken();
        $currentAccessToken->delete();
        return $this->successResponse('logged out successfully');
    }
    public function forgetPassword(Request $request){
        $mobile = $request->get('s_mobile');
        $user = TUser::where('s_mobile', $mobile)->first();
        if ($user) {
            // $code = random_int(1000, 9999);
            $user->update(
                [
                    's_verify_code' => '5555',
                    'sent_code_date' => date('Y-m-d H:i:s'),
                ]
            );
            // Mail::send('emails.verifyEmail', ['code' => $code], function ($message) use ($user) {
        //     $message->to($user->s_email)->subject('Confirm email');
        // });
            return $this->successResponse(__('alerts.ckecked_your_phone'));
        } else {
            return $this->successResponse(__('alerts.phone_is_not_registered')) ->addResponseField('records' , null);
        }

    }
    public function confirmCode(Request $request)
    {
        $code = $request->get('s_verify_code');
        $mobile = $request->get('s_mobile');
        $user = TUser::where('s_mobile', $mobile)->first();
        if (!$user) goto mobile_not_found;
        if ($code != $user->s_verify_code) goto code_is_incorrect;
        $user->update(
            [
                'b_email_verified' => 1,
            ]
        );

        return $this->successResponse(__('alerts.mobile_is_verified'));

        code_is_incorrect:
        return $this->failResponse(__('alerts.code_is_incorrect'));

        mobile_not_found:
        return $this->failResponse(__('alerts.mobile_is_not_registered'));
    }
    public function createNewPassword(Request $request){
        $request->validate([
            's_mobile' => 'required|string|exists:t_users,s_mobile',
            's_password' => 'required|min:8|confirmed',
        ]);
        $mobile = $request->get('s_mobile');
        $user = TUser::where('s_mobile', $mobile)->first();

        if ($user) {
            $user->s_password = $request->get('s_password');
            $user->save();
            $token = $user->createToken('login');
            $user['s_access_token'] = $token->plainTextToken;
            // return $this->successResponse(__('alerts.password_created_successfully'));
             return $this->successResponse(__('alerts.password_created_successfully'), new UserResource($user),'user');
        }
        return $this->failResponse(__('alerts.email_is_incorrect'));
    }

    public function checkEmail(Request $request)
    {
        $email = $request->get('s_email');

        $user = TUser::where('s_email', $email)->exists();
        if ($user) {
            return $this->successResponse(__('alerts.email_is_registered'));
        } else {
            return $this->notFoundResponse(__('alerts.email_is_not_registered'));
        }
    }
    public function changePassword(Request $request)
    {
        $validator = Validator($request->all(),[
            's_password' => 'required|min:8|password',
            's_new_password' => 'required|min:8|confirmed',
        ]);
        if(!$validator->fails()){
            $user = TUser::where('pk_i_id', auth()->id())->first();
            $user->s_password = $request->get('s_new_password');
            $user->save();
            $token = $user->createToken('login');
            $user['s_access_token'] = $token->plainTextToken;
            return $this->successResponse(__('alerts.password_changed_successfully'));
        }
        return $this->failResponse(__('alerts.password_is_incorrect'));
    }


}
