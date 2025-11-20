<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreAdminRequest extends BaseFormRequest
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
        $primaryKey = $this->get('pk_i_id');

        return [
            's_name' => 'required',
            's_email' => 'required|email|unique:t_admin,s_email,' . $primaryKey . ',pk_i_id,dt_deleted_date,NULL',
            's_username' => 'required|unique:t_admin,s_username,' . $primaryKey . ',pk_i_id,dt_deleted_date,NULL',
            's_mobile' => 'numeric|digits_between:10,14',
            's_password' => [
                Password::min(8),
                Rule::requiredIf(function () {
                    return !$this->filled('pk_i_id');
                }),
                'min:6',
                'nullable'
            ],
            's_confirm_password' => [
                Rule::requiredIf(function () {
                    return !$this->filled('pk_i_id');
                }),
                'same:s_password'
            ],
            's_avatar' => [
                'nullable',
                'image',
                'max:' . $this->imageMaxSize
            ]
        ];
    }
}
