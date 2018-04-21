<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;

class PropertyRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $all = $this->all();
        if ($all['type'] != 'other') $all['category_id'] = 0;
        if ($all['type'] != 'color') $all['value'] = str_slug($all['value']);
        if ($all['type'] != 'color' && $all['type'] != 'brand' && $all['type'] != 'other') $all['type'] = 'color';
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
        if($this->method()=='PATCH')
        {
            return [
                'name' => "required|min:1|max:255|unique:properties,name," . $this->property,
                'image' => 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
            ];
        }
        else{
            return [
                'name' => "required|min:4|max:255|unique:properties",
                'image' => 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
            ];
        }
    }
}
