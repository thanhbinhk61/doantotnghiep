<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;

class RoleRequest extends Request
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
        if($this->method()=='PATCH')
        {
            return [
                'name' => "required|alpha_dash|min:4|max:255|unique:roles,name," . $this->role,
                'ability_id' => "required",
            ];
        }
        else{
            return [
                'name' => "required|alpha_dash|min:4|max:255|unique:roles",
                'ability_id' => "required",
            ];
        }
    }
}
