<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends BaseFormRequest
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
           's_name' => 'required|string|max:255',
            's_id_number' => 'required|string|max:50|unique:t_users,s_id_number',
            's_avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            's_mobile' => 'required|string|max:20|unique:t_users,s_mobile',
            's_mobile_whats' => 'nullable|string|max:20',
            's_email' => 'nullable|email|max:255|unique:t_users,s_email',
            's_password' => 'required|string|min:8|confirmed',
            's_password_confirmation' => 'required_with:s_password|string|min:8'
        ];
    }
}
