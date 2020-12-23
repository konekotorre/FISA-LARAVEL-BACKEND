<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactoRequest extends FormRequest
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
            'organizacion_id' => 'required',
            'tipo_documento_persona_id' => 'required',
            'oficina_id' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'sexo' => 'required',
            'cargo' => 'required',
            'telefono' => 'required',
            'celular' => 'required',
            'email' => 'required',
            'email' => 'unique:contactos,email',
            'estado' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'organizacion_id.required' => 'La organizacion a la cual pertenece es requerida',
            'tipo_documento_persona_id.required' => 'El tipo de documento es requerido',
            'oficina_id.required' => 'La oficina a la cual pertenece es requerida',
            'nombres.required' => 'Los nombres del contacto son necesarios',
            'apellidos.required' => 'Los apellidos del contacto son requeridos',
            'sexo.required' => 'El sexo biológico del contacto es requerido',
            'cargo.required' => 'El cargo del contacto es requerido',
            'telefono.required' => 'El telefono del contacto es requerido',
            'celular.required' => 'El celular del contacto es requerido',
            'email.required' => 'El correo del contacto es requerido',
            'email.unique' => 'El correo del contacto debe ser único',
            'estado.required' => 'El estado para este contacto es requerido',
        ];
    }
}
