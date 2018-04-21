<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;

class ConfigRequest extends Request
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
            'title' => "required|min:2|max:255",
            'keywords' => "max:255",
            'description' => "max:255",
            'email' => "required|email|min:4|max:255",
            'intro' => "max:255",
            'logo1' => 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
            'logo2' => 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
            'logo3' => 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
            'banner_login' => 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
        ];
    }
}
