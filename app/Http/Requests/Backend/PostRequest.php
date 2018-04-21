<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;

class PostRequest extends Request
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
        if (empty($all['description'])) $all['description'] = $all['intro'];
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
                'name' => "required|min:4|max:255|unique:posts,name," . $this->post,
                'cate_id' => "required",
                'image' => 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
            ];
        }
        else{
            return [
                'name' => "required|min:4|max:255|unique:posts",
                'cate_id' => "required",
                'image' => 'required|image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
            ];
        }
    }
}
