<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\FocusResource;
use App\Http\Resources\Api\V1\HomeResource;
use App\Http\Resources\Api\V1\SettingResource;
use App\Models\TMuscle;
use App\Models\TSetting;
use Illuminate\Http\Request;

class HomeController extends ApiBaseController
{
    public function home()
    {
        $user = auth()->user();
        $muscles = TMuscle::enabled()->get();
        return $this->setSuccess('')
        ->addResponseField('user', new HomeResource($user))
        ->addResponseField('muscles',FocusResource::collection($muscles))
        ->getResponse();
    }
    public function settinges(){
        $settings = TSetting::enabled()->pluck('s_value', 's_key')->toArray();
        return response()->json([
            'status' => [
                "success" => true,
                "code" => 200
            ],
            'settings' => $settings
        ]);
    }
}
//->addResponseField('count', $count)
