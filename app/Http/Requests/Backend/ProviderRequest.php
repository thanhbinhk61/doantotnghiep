<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;

class ProviderRequest extends Request
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
            'image' => 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
            'logo' => 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
        ];
    }
}
