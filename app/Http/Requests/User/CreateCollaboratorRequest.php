<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCollaboratorRequest extends FormRequest
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
                'max:70'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->where('deleted_at', null)
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],
            'office_id' => [
                'required',
                'integer',
                'exists:offices,id'
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Esse e-mail já está cadastrado.',
        ];
    }
}
