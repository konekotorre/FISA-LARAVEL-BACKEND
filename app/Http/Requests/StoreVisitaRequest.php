<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisitaRequest extends FormRequest
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
            'fecha_programada' => 'required',
            'titulo' => 'required',
            'razon' => 'required',
            'usuario_asignado' => 'required',
            'contacto_id' => 'required',
            'oficina_id' => 'required',
            'estado' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'organizacion_id.required' => 'La organizacion a la cual se le realiza la visita es requerida',
            'fecha_programada.required' => 'La fecha de programación es requerida',
            'titulo.required' => 'El título de la visita es requerido',
            'razon.required' => 'La razón de la visita es requerida',
            'usuario_asignado.required' => 'El usuario asignado es requerido',
            'contacto_id.required' => 'El contacto que debe recibir la visita es requerido',
            'oficina_id.required' => 'La oficina en la cual se va a realizar la visita es requerida',
            'estado.required' => 'El estado de la visita es requerido',
        ];
    }
}
