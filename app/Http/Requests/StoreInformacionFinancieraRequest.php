<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInformacionFinancieraRequest extends FormRequest
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
            'ingresos_anuales' => 'required',
            'egresos_anuales' => 'required',
            'ingresos_operacionales' => 'required',
            'egresos_operacionales' => 'required',
            'ingresos_no_operacionales' => 'required',
            'egresos_no_operacionales' => 'required',
            'total_activos' => 'required',
            'total_pasivos' => 'required',
            'patrimonio_total' => 'required',
            'regimen_id' => 'required',
            'temporada_declaracion' => 'required',
            'empleados_directos' => 'required',
            'fecha_fundacion' => 'required',
            'estado' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'organizacion_id.required' => 'La organizacion a la cual pertenece es requerida',
            'ingresos_anuales.required' => 'Los ingresos anuales son requeridos',
            'egresos_anuales.required' => 'Los egresos anuales son requeridos',
            'ingresos_operacionales.required' => 'Los ingresos operacionales son requeridos',
            'egresos_operacionales.required' => 'Los egresos operacionales son requeridos',
            'ingresos_no_operacionales.required' => 'Los ingresos no operacionales son requeridos',
            'egresos_no_operacionales.required' => 'Los egresos no operacionales son requeridos',
            'total_activos.required' => 'El total de activos es requerido',
            'total_pasivos.required' => 'El total de pasivos es requerido',
            'patromonio_total.required' => 'El patrimonio total es requerido',
            'regimen_id.required' => 'El regimen es requerido',
            'temporada_declaracion.required' => 'El año de declaracion es requerido',
            'fecha_fundacion.required' => 'La fecha de fundacion es requerida',
            'estado.required' => 'El estado es requerido',
        ];
    }
}
