<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CategoryResource;
use App\Http\Resources\Api\V1\ProfileResource;
use App\Http\Resources\Api\V1\ShortPropertyResource;
use App\Models\TCategory;
use App\Models\TUser;
use Illuminate\Http\Request;
use App\Models\TFavorite;
use App\Models\TServiceRating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class GeneralContrller extends ApiBaseController
{
     public function profile(Request $request)
    {
        $user = auth()->user();
         return $this->successResponse('',  new ProfileResource($user), 'user');
    }
    public function selectUserType(Request $request){
         $data = $request->validate([
            'e_type' => ['required', Rule::in(['Office', 'Individual'])],
        ]);
        $user = auth()->user();
        $user->e_type = $request->e_type;
        $user->save();
         return $this->successResponse(__('alerts.user_type_changed_successfully'));
    }
      public function update_profile(Request $request)
    {
        $user = auth()->user();
        $data = $request->except('s_avater' , 's_id_image');

        if ($request->hasFile('s_avater')) {
            $data['s_avater'] = $request->file('s_cover')->store('uploads/user');
        }

        if ($request->hasFile('s_id_image')) {
            $data['s_id_image'] = $request->file('s_id_image')->store('uploads/user');
        }
         $user->update($data);

         return $this->successResponse('',  new ProfileResource($user), 'user');
    }
     public function change_password(Request $request)
    {
        $validator = Validator($request->all(),[
            's_password' => 'required|min:8|password',
            's_new_password' => 'required|min:8|confirmed',
        ]);
        if(!$validator->fails()){
            $user = auth()->user();
            $user->s_password = $request->get('s_new_password');
            $user->save();

            return $this->successResponse(__('alerts.password_changed_successfully'));
        }
        return $this->failResponse(__('alerts.password_is_incorrect'));
    }
     public function categoris(Request $request)
    {
        $categoris = TCategory::enabled()->get();
        return $this->successResponse('', CategoryResource::collection($categoris), 'categoris');
    }
        public function toggleFavorite(Request $request)
    {
        $userId = Auth::id();
        $propertyId = $request->property_id;

        $favorite = TFavorite::where('fk_i_user_id', $userId)
            ->where('fk_i_property_id', $propertyId)
            ->first();

        if ($favorite) {
            $favorite->forceDelete();
             return $this->successResponse(__('alerts.favorite_deleted_successfully'));
        } else {
            TFavorite::create([
                'fk_i_user_id' => $userId,
                'fk_i_property_id' => $propertyId,
            ]);
            return $this->successResponse(__('alerts.favorite_added_successfully'));
        }
    }

    public function favorites()
    {
        $userId = Auth::id();
        $favorites = TFavorite::where('fk_i_user_id', $userId)
            ->with('property')
            ->get();

       return $this->successResponse('', ShortPropertyResource::collection($favorites), 'favorites');
    }
    public function rating(Request $request)
    {
        $data = $request->validate([
            'property_id' => 'required|integer|exists:t_properties,pk_i_id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $rating = TServiceRating::create([
            'fk_i_user_id' => auth()->id(),
            'fk_i_property_id' => $data['property_id'],
            'rating' => $data['rating'],
            'comment' => $data['comment'] ?? null,
        ]);
        //  return $this->successResponse('', ShortPropertyResource::collection($rating), 'rating');
        return $this->successResponse(__('alerts.rating_added_successfully'));

    }
}
