<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PropertyRequest extends BaseFormRequest
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
            'fk_i_category_id' => 'nullable|exists:t_categories,pk_i_id',
            'fk_i_user_id' => 'nullable|exists:t_users,pk_i_id',
            's_address' => 'nullable|string|max:1000',
            's_cover' => 'nullable|image|mimes:' . $this->allowedImageExtensions() . '|max:' . $this->imageMaxSize(),
            's_conditions' => 'nullable|string',
            's_description' => 'nullable|string|max:2000',
            'n_price' => 'nullable|numeric|min:0',
            's_area' => 'nullable|string|max:255',
            'n_family_members' => 'nullable|integer|min:0',
            'n_rooms' => 'nullable|integer|min:0',
            'n_bathrooms' => 'nullable|integer|min:0',
            'n_lounges' => 'nullable|integer|min:0',
            's_floors' => 'nullable|integer|min:0',
            'e_furnished' => ['required', Rule::in(['Unfurnished', 'Semi-furnished', 'Furnished'])],
            'e_status' => ['required', Rule::in(['new','uses'])],
            'e_finishing_quality' => ['required', Rule::in(['Deluxe','Normal'])],
            's_additional_features' => 'nullable|string|max:1000',
            's_surrounding_area' => 'nullable|string|max:1000',
            'e_water_conservation' => ['required', Rule::in(['Government-project','Community-project','Whites'])],
        ];
    }
}
