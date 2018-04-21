<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;

class ExpenseRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $all = $this->all();
        
        if (!empty($all['price']) && isset($all['price']) ) $all['price'] = str_replace(',','',$all['price']); 
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
            'name' => "required|min:2|max:255",
        ];
    }
}
