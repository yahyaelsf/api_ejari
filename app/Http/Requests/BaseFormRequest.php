<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class BaseFormRequest extends FormRequest
{
    protected $appends = [];
    protected $imageMaxSize;
    protected $fileMaxSize;

    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);

        $this->imageMaxSize = config('constants.image-size');
        $this->fileMaxSize = config('constants.file-size');
    }

    protected function failedValidation(Validator $validator) {
        if(request()->wantsJson()){
            throw new HttpResponseException(
                response()->json([
                    'success' => false,
                    'message' => trans('alerts.validation_failed'),
                    'errors' => $validator->errors()->all(),
                    'sorted_errors' => $validator->errors(),
                    'appends' => $this->appends
                ], 200)
            );
        }

        throw (new ValidationException($validator))->errorBag($this->errorBag)
                                                   ->redirectTo($this->getRedirectUrl());

    }


    public function getIntParam($key) {
        return (int) $this->{$key};
    }

}
