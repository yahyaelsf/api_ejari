<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ProfileRequest;
use App\Http\Resources\Api\V1\ProfileResource;
use App\Http\Resources\Api\V1\UserDetialsResource;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\TUser;
use App\Models\TUserDetials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends ApiBaseController
{
    public function update(ProfileRequest $request)
    {
        $data = $request->except('s_avater');
        $user = TUser::where('pk_i_id', auth()->id())->first();
        $detial =TUserDetials::where('fk_i_user_id' , $user->pk_i_id)->first();
        DB::beginTransaction();
        try {
            if ($avatar = $request->file('s_avatar')) {
            $user->update([
                $user->s_avatar = $avatar->store('uploads/avatars'),
            ]);
            }
            $user->update([
                $user->s_name = $data['s_name'],
                $user->s_email = $data['s_email'],
            ]);
            $user->save();
            $detial->update([
                $detial->dt_birth_date = $data['dt_birth_date'],
                $detial->i_length = $data['i_length'],
                $detial->i_weight = $data['i_weight'],
            ]);
            $detial->save();


        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => trans('alerts.validation_errors'),
            ]);
        }
        DB::commit();

        return $this->successResponse(
            trans('alerts.successfully_updated'),
            new ProfileResource($user->fresh()->load('detial')),
            'user'
        );
    }
}
