<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;

class ProductRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $all = $this->all();
        if (isset($all['video'])) $all['video'] = $this->getKeyYoutube($all['video']);
        if (empty($all['title'])) $all['title'] = $all['name'];
        if (empty($all['description'])) $all['description'] = $all['intro'];
        if (!empty($all['quantity']) && isset($all['quantity']) ) $all['quantity'] = str_replace(',','',$all['quantity']); 
        if (!empty($all['price']) && isset($all['price']) ) $all['price'] = str_replace(',','',$all['price']); 
        if (!empty($all['price_sale']) && isset($all['price_sale']) ) $all['price_sale'] = str_replace(',','',$all['price_sale']); 
        if (!empty($all['discount_price']) && isset($all['discount_price']) ) $all['discount_price'] = str_replace(',','',$all['discount_price']); 
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
                'name' => "required|min:4|max:255|unique:products,name," . $this->product,
                'code' => "required|min:4|max:255|unique:products,code," . $this->product,
                'cate_id' => "required",
                'price' => "not_in:0",
                'image' => 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
            ];
        }
        else{
            return [
                'name' => "required|min:4|max:255|unique:products",
                'code' => "required|min:4|max:255|unique:products",
                'cate_id' => "required",
                'price' => "not_in:0",
                'image' => 'required|image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
            ];
        }    
    }

    public function getKeyYoutube($url)
    {
        if(strlen($url) > 11)
        {
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
            {
                return $match[1];
            }
            else
                return false;
        }
        return $url;
    }
}
