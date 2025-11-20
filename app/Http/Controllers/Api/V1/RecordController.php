<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\RecordRequest;
use App\Http\Resources\Api\V1\RecordResource;
use App\Models\TRecord;
use Illuminate\Http\Request;

class RecordController extends ApiBaseController
{
     public function store(RecordRequest $request)
    {

        $record = new TRecord();
        $record->dt_record_date = $request->dt_record_date;
        $record->fk_i_user_id = auth()->id();
        $record->save();

         $exercises = explode(',' , $request->exercises);
        if ($exercises) {
                $record->exercises()->sync($exercises ?? []);
            }
        return $this->successResponse(
            trans('alerts.successfully_updated'),
            new RecordResource($record->fresh()->load('exercises')),
            'record'
        );

    }
    public function record($date){
        $user = auth()->user();
        $record = TRecord::where('dt_record_date',$date)->where('fk_i_user_id',$user->pk_i_id)->first();
        if(!$record){
           return response()->json([
            "status" => [
            "success"=>true,
            "message"=>"تم  تحديث العنصر بنجاح",
            "code"=>200
            ],
            'records' => null
           ]);
        }
          return $this->successResponse(
            trans('alerts.successfully_updated'),
            new RecordResource($record->fresh()->load('exercises')),
            'record'
        );
    }
}
