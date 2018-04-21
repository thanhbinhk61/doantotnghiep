<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\Request;

class CustomerAddressRequest extends Request
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
            'ship_id' => "required|not_in:0",
            'address' => "required"
        ];
    }

    public function messages()
    {
        return [
            'required'  =>  ':attribute không được bỏ trống.',
            'name.min' => 'Tên phải lớn hơn :min ký tự',
            'ship_id.not_in' => 'Bạn phải chọn khu vực'
        ];
    }
}
