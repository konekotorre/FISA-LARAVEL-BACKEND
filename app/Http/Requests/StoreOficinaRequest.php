<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOficinaRequest extends FormRequest
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
            'direccion' => 'required',
            'tipo_oficina_id' => 'required',
            'pais_id' => 'required',
            'departamento_estado_id' => 'required',
            'ciudad_id' => 'required',
            'telefono_1' => 'required',
            'estado' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'organizacion_id.required' => 'La organizacion a la cual pertenece es requerida',
            'direccion.required' => 'La dirección de la oficina es requerida',
            'tipo_oficina_id.required' => 'El tipo de oficina es requerido',
            'pais_id.required' => 'El país donde se ubica es requerido',
            'departamento_estado_id.required' => 'El estado o departamento donde se ubica es requerido',
            'ciudad_id.required' => 'La ciudad en la cual se ubica es requerida',
            'telefono_1.required' => 'Al menos un número de telefono es requerido',
            'estado.required' => 'El estado para esta oficina es requerida',
        ];
    }
}
