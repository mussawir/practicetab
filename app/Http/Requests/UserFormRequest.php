<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserFormRequest extends Request
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
        $rules = [
            'full_name' => 'required|max:50',
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|min:8',
        ];

        return $rules;
    }
}
