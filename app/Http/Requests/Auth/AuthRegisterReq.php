<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Utils\FormRequestUtil;

class UserRegister extends FormRequestUtil
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
            'gender' => 'required|validator_gender',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:user,email',
            'phone' => 'required|validator_mobile_phone_fr|unique:user,phone',
            'password' => 'required|between:6,20',
            'cgu' => 'required|boolean',
            'birth_date' => 'required|validator_birth_date'
        ];
    }

}
