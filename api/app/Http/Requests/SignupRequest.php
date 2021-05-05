<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'names' => [
                'required', 'string'
            ],
            'lastnames' => [
                'required', 'string'
            ],
            'username' => [
                'required', 'string'
            ],
            'email' => [
                'required', 'email', 'unique:users'
            ],
            'password' => [
                'required', 'string', 'confirmed'
            ],
        ];
    }

    public function messages()
    {
        return [
            'names.required' => 'Los nombres son requeridos',
            'lastnames.required' => 'Los apellidos son requeridos',
            'username.required' => 'El nombre de usuario es requerido',
            'email.required' => 'El correo electronico es requerido',
            'email.unique' => 'El correo electronico ya se encuentra registrado',
            'password.required' => 'Ingrese su contraseña',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ];
    }
}
