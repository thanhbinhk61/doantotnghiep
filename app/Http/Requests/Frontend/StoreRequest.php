<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\Request;

class StoreRequest extends Request
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
            'name' => "required|min:2|max:255",
            'phone' => "required|min:2|max:255",
            'store_show' => "required|min:2|max:255",
            'email' => "required|email|min:2|max:255",
            'company_name' => "required|min:2|max:255",
            'company_type' => "required|not_in:0",
            'category_id' => "required|not_in:0",
        ];
    }

    public function messages()
    {
        return [
            'required'  =>  ':attribute không được bỏ trống.',
            'email.email' => 'Bạn phải nhập đúng định dạng email'
        ];
    }
}
