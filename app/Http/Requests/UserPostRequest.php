<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPostRequest extends FormRequest
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
            'txttitle'              => 'required',
            'txtcontent'              => 'required',
        ];
    }

    public function messages()
    {
        return [
            'txttitle.required'              => 'Vui lòng nhập tiêu đề bài viết',
            'txtcontent.required'                => 'Vui lòng nhập nội dung bài viết',
        ];
    }
}
