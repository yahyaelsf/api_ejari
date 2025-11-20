<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class BaseFormRequest extends FormRequest
{
    protected $imageExtensions = ['jpeg', 'png', 'jpg', 'gif'];
    protected $imageMaxSize = '5120';


    public function allowedImageExtensions()
    {
        return implode(',', $this->imageExtensions);
    }


    public function imageMaxSize()
    {
        return $this->imageMaxSize;
    }
}
