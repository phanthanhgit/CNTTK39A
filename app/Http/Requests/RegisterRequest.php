<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'txtusername'              => 'required|unique:users,username',
            'txtpassword'              => 'required',
            'txtpassword_confirmation' => 'required|same:txtpassword',
            'txtemail'                 => 'required|email|unique:users,email'
        ];
    }

    public function messages()
    {
        return [
            'txtusername.required'              => 'Vui lòng nhập họ tên người dùng',
            'txtusername.unique'                => 'Tên đăng nhập đã được sử dụng',
            'txtpassword.required'              => 'Vui lòng nhập mật khẩu',
            'txtpassword_confirmation.required' => 'Vui lòng nhập lại mật khẩu',
            'txtpassword_confirmation.same'     => 'Mật khẩu không trùng khớp',
            'txtemail.email'                    => 'Vui lòng nhập đúng định dạng email',
            'txtemail.required'                 => 'Vui lòng nhập email',
            'txtemail.unique'                   => 'Email đã được sử dụng'
        ];
    }
}
