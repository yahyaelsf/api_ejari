<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCkeEditorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CkeEditorController extends Controller
{
    public function uploadFile(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'upload' => 'required|image|max:' . config('constants.image-size')
        ]);


        if (!$validated->fails() && $request->hasFile('upload')) {

            $filenameWithExtension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);


            $fileUrl = $request->file('upload')->store('uploads/news');

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset($fileUrl);
            $msg = trans('alerts.successfully_added');

            return response()->json([
                'fileName' => $msg,
                'uploaded' => true,
                'url' => $url
            ]);
        }

    }
}
