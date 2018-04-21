<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\Request;

class CustomerUpdateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $all = $this->all();
        if ( isset ($all['email']) ) unset($all['email']);
        if ( isset ($all['facebook_id']) ) unset($all['facebook_id']);
        if ( isset ($all['google_id']) ) unset($all['google_id']);
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
        return [
            'name' => "required|min:4|max:255",
            'age' => "integer",
            'password' => 'confirmed|min:6',
            'password_confirmation' => 'min:6'
        ];
    }
}
