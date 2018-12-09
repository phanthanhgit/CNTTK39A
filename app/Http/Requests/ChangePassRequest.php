<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassRequest extends FormRequest
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
            'txtpassword'              => 'required',
            'txtpassword_confirmation' => 'required|same:txtpassword',
        ];
    }

    public function messages()
    {
        return [
            'txtpassword.required'              => 'Vui lòng nhập mật khẩu',
            'txtpassword_confirmation.required' => 'Vui lòng nhập lại mật khẩu',
            'txtpassword_confirmation.same'     => 'Mật khẩu không trùng khớp',
        ];
    }
}
