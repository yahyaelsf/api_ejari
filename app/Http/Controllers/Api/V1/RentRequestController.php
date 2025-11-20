<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreRentRequest;
use App\Http\Resources\Api\V1\RentRequestResource;
use App\Models\TRentRequest;
use Illuminate\Http\Request;

class RentRequestController extends ApiBaseController
{
     public function index(Request $request)
    {
        $rent_requests = TRentRequest::enabled()->get();
        return $this->successResponse('', RentRequestResource::collection($rent_requests), 'rent_requests');
    }
     public function store(StoreRentRequest $request)
    {

         $data = $request->validated();
        if (empty($data['fk_i_user_id']) && auth()->check()) {
            $data['fk_i_user_id'] = auth()->id();
        }
         $rentRequest = TRentRequest::create($data);
        return response()->json([
            'status' => true,
            'message' => 'تم إرسال الطلب بنجاح',
            'data' => $rentRequest,
        ], 201);
    }
     public function show(TRentRequest $rent_request)
    {
        return $this->successResponse('',  new RentRequestResource($rent_request), 'rent_request');
    }
}
