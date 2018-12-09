<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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

    public function rules()
    {
        return [
            'txtemail' => 'required|email',
            'txtpassword'  => 'required'
        ];
    }

    public function messages()
    {
        return [
            'txtemail.required' => 'Vui lòng nhập email',
            'txtpassword.required'  => 'Vui lòng nhập mật khẩu'
        ];
    }
}
