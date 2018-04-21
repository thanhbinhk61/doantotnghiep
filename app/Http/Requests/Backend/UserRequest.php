<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;

class UserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $all = $this->all();
        if ( !isset($all['password']) || empty($all['password'])) unset($all['password']);
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
                'name' => "required|min:4|max:255",
                'username' => "required|alpha_dash|min:4|max:255|unique:users,username," . $this->user,
                'email' => "required|email|max:255|unique:users,email," . $this->user,
                'password' => 'confirmed|min:6',
                'password_confirmation' => 'min:6',
                'role_id' => "required",
                'image'=> 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
            ];
        }
        else{
            return [
                'name' => "required|min:4|max:255",
                'username' => "required|alpha_dash|min:4|max:255|unique:users",
                'email' => "required|email|max:255|unique:users",
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => 'required|min:6',
                'role_id' => "required",
                'image'=> 'image|mimes:jpeg,jpg,gif,bmp,png|max:1200',
            ];
        }
    }
}
