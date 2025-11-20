<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends BaseFormRequest
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
            // 's_email' => 'required|string|email|exists:t_users,s_email',
            's_mobile' => 'required|string|exists:t_users,s_mobile',
            's_password' => 'required|string'
        ];
    }
}
