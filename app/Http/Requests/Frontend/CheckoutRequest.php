<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\Request;

class CheckoutRequest extends Request
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
        if($this->method()=='PATCH')
        {
            return [
                'name' => "required|min:2|max:255",
                'email' => "email|max:255|unique:customers,email," . $this->order,
                'ship_id' => "required|not_in:0",
                'phone' => 'required',
                'address' => 'required'
            ];
        } else{
            return [
                'name' => "required|min:2|max:255",
                'ship_id' => "required|not_in:0",
                'email' => "email|unique:customers",
                'phone' => 'required',
                'address' => 'required'
            ];
        }
    }

    public function messages()
    {
        return [
            'required'  =>  ':attribute không được bỏ trống.',
            'phone.required' => 'Số điện thoại không đưọc bỏ trống',
            'address.required' => 'Số điện thoại không đưọc bỏ trống',
            'name.min' => 'Tên phải lớn hơn :min ký tự',
            'email.email'  => 'Phải đúng định dạng Email',
            'email.unique'  => 'Bạn đã có tài khoản bằng email này. Hãy đăng nhập',
            'ship_id.not_in' => 'Bạn phải chọn khu vực'
        ];
    }
}
