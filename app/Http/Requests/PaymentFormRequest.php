<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PaymentFormRequest extends Request
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
            'cc_number' => 'required|min:15',
            'cc_cvv' => 'required|min:3',
            'terms' => 'required'
        ];
    }

    // custom messages
    public function messages()
    {
        return [
            'cc_number.required' => 'The credit card number is field required.',
            'cc_number.min' => 'The credit card number must be at least 15 characters.',
            'cc_cvv.required' => 'The security code is field required.',
            'cc_cvv.min' => 'The security code must be at least 3 characters.',
            'terms.required' => 'You must be agreed with terms and conditions before proceed',
        ];
    }
}
