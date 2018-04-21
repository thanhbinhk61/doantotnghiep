<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;

class CategoryRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $all = $this->all();
        if (empty($all['title'])) $all['title'] = $all['name'];
        if (empty($all['feature'])) $all['feature'] = 1;
        if (empty($all['description']) && isset($all['intro'])) $all['description'] = $all['intro'];
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
            'image' => 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
        ];
    }
}
