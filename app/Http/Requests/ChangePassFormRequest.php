<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Request;

class ChangePassFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => 'required|min:8|old_pass_vld:'.Auth::user()->password,
            'new_password' => 'required|min:8|different:old_password',
            'password_confirmation' => 'required|min:8|same:new_password',
        ];
    }

    // custom messages
    public function messages()
    {
        return [
            'old_password.old_pass_vld' => 'The old password is not correct.',
        ];
    }
}
