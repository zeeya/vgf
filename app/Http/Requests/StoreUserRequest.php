<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
        switch ($this->method()) {
            case 'PUT':
            case 'POST': {
                $id = (int) $this->input('id', 0);
                $unique_id = ($id > 0) ? ',' . $id : '';

                $password = ($id > 0) ? "" : "required";
                $logo = ($id > 0) ? "" : "required";

                return [
                    "id" => "",
                    "firstname" => "required",
                    "lastname" => "required",
                    "email" => "required",
                    "password" => $password,
                ];
            }
            default:break;
        }
    }



    public function messages()
    {
        return [
            'name.required' => 'Le nom d\'utilisateur est obligatoire',
            'email.required' => 'Email d\'utilisateur est requis',
            'password.required' => 'Mot de passe requis',
        ];
    }
}
