<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTareaRequest extends FormRequest
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
            'visita_id' => 'required',
            'fecha_programada' => 'required',
            'titulo' => 'required',
            'descripcion' => 'required',
            'usuario_asignado' => 'required',
            'estado' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'visita_id.required' => 'La visita relacionada a esta tarea es requerida',
            'fecha_programada.required' => 'La fecha programada es requerido',
            'titulo.required' => 'El título es requerido',
            'descripcion.required' => 'La descripcion de la tarea es requerida',
            'usuario_asignado.required.' => 'El usuario asignado es requerido',
            'estado.required' => 'El estado es requerido',
        ];
    }
}
