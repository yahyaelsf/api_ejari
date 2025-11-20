<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StorePermissionRequest extends BaseFormRequest
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
            'name' => 'required|string',
            'display_name' => [Rule::requiredIf(function () use ($primaryKey) {
                return empty($primaryKey);
            }), 'string'],
            'parent_id' => ['nullable', Rule::exists('permissions', 'id')->whereNull('parent_id')]
        ];
    }
}
