<?php

namespace App\Http\Requests\Api\V1;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            's_avatar' => 'nullable|image|mimes:' . $this->allowedImageExtensions() . '|max:' . $this->imageMaxSize(),
            's_name' => ['nullable', 'string', 'max:255'],
            's_email' => 'nullable|email|max:255|exists:t_users,s_email',
            'dt_birth_date' => 'nullable|date',
            'i_length' => 'nullable|numeric',
            'i_weight' => 'nullable|numeric',
        ];
    }
}

