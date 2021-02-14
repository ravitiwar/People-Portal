<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends ApiRequest
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
        return  $this->isMethod('PUT')?$this->getUpdateRules():$this->getCreateRules();
    }

    function getUpdateRules(){
        return[
            'name' => 'required|string',
            'email' => 'required|unique:users,email,'.$this->id,
            'password' => 'confirmed',
            'emp_id' => 'required|string',
            'position' => 'required|string',
            'team' => 'required|string',
            'role_id' => 'required|exists:roles,id',
            'phone' => 'required|string'
        ] ;
    }

    function getCreateRules(){
        return[
            'name' => 'required|string',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
            'emp_id' => 'required|string',
            'position' => 'required|string',
            'team' => 'required|string',
            'role_id' => 'required|exists:roles,id',
            'phone' => 'required|string'
        ] ;
    }
}
