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
        return [
            'nombres' => 'required',
            'apellidos' => 'required',
            'tipo_documento_persona_id' => 'required',
            'numero_documento' => 'required',
            'usuario' => 'required',
            'password' => 'required',
            'password' => 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,12}$/',
            'email' => 'required',
            'email' => 'unique:users,email',
            'rol' => 'required',
            'estado' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nombres.required' => 'Los nombres del usuario son requeridos',
            'apellidos.required' => 'Los apellidos del usuario son requeridos',
            'tipo_documento_persona_id.required' => 'El tipo de documento es requerido',
            'numero_documento.required' => 'El número de documento es requerido',
            'usuario.required' => 'El nombre de usuario es requerido',
            'usuario.unique' => 'El nombre de usuario debe ser único',
            'password.required' => 'La contraseña es requerida',
            'password.regex' => 'La contraseña debe tener entre 6 y 12 caracteres, al menos una letra mayuscula y al menos un número.',
            'email.required' => 'El correo es requerido',
            'email.unique' => 'El correo debe ser unico',
            'rol.required' => 'El rol del usuario es requerido',
            'estado.required' => 'El estado es requerido',
        ];
    }
}
