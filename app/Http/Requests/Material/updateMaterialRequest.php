<?php

namespace App\Http\Requests\Material;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class updateMaterialRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:70',
                Rule::unique('materials')->ignore($this->material, 'id')
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Esse material já está cadastrado.',
        ];
    }
}
