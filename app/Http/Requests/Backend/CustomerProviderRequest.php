<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;

class CustomerProviderRequest extends Request
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
                'password' => 'confirmed|min:6',
                'password_confirmation' => 'min:6',
            ];
        }
        else{
            return [
                'name' => "required|min:2|max:255",
                'email' => "required|email|max:255|unique:customers",
                'provider_id' => "required",
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => 'required|min:6',
            ];
        }
    }
}
