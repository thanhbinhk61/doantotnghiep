<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\Request;

class ShipRequest extends Request
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
        if (\Auth::guard('frontend')->check()) {
            return [
                'link' => "required",
            ];
        } else {
            return [
                'link' => "required",
                'name' => 'required',
                'email' => "required|email|max:255",
            ];
        }
    }

    public function messages()
    {
        return [
            'required'  =>  ':attribute không được bỏ trống.',
            'email.email' => 'Bạn phải nhập đúng định dạng email'
        ];
    }
}
