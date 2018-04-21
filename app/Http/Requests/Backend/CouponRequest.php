<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;

class CouponRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $all = $this->all();
        if (!empty($all['value']) && isset($all['value']) ) $all['value'] = str_replace(',','',$all['value']); 
        if (!empty($all['min']) && isset($all['min']) ) $all['min'] = str_replace(',','',$all['min']); 
        $this->replace($all);
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
            'name' => "required|min:4|max:255",
            'expired_at' =>"required|date|date_format:d-m-Y H:i|after:yesterday",
            'quantity' => "integer|between:1,100"
        ];
    }
}
