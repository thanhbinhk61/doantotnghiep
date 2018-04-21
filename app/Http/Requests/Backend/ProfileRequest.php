<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;

class ProfileRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $all = $this->all();
        if ( !isset($all['password']) || empty($all['password']) ) unset($all['password']);
        if ( isset ($all['username']) ) unset($all['username']);
        if ( isset ($all['email']) ) unset($all['email']);
        if ( isset ($all['role_id']) ) unset($all['role_id']);
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
            'password' => 'confirmed|min:6',
            'password_confirmation' => 'min:6',
            'image'=> 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
        ];
    }
}
