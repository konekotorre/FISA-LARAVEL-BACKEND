<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrganizacionRequest extends FormRequest
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
            'nombre' => 'required',
            'tipo_documento_organizacion_id' => 'required',
            'numero_documento' => 'required',
            'razon_social' => 'required',
            'categoria_id' => 'required',
            'fecha_afiliacion' => 'required',
            'pais_id' => 'required',
            'tipo_organizacion_id' => 'required',
            'clase_id' => 'required',
            'sector_id' => 'required',
            'subsector_id' => 'required',
            'estado' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre de la organizacion es requerido',
            'tipo_documento_organizacion_id.required' => 'El tipo de documento es requerida',
            'numero_documento.required' => 'El número de documento es requerido',
            'razon_social.required' => 'La razón social es requerida',
            'categoria_id.required' => 'La categoria es requerida',
            'afiliaciones_gremios.required' => 'Las afiliaciones a gremios son requeridas',
            'fecha_afiliacion.required' => 'La fecha de afiliación es requerida',
            'pais_id.required' => 'El país de la organizacion es requerido',
            'tipo_organizacion_id.required' => 'El tipo de organizacion es requerido',
            'clase_id.required' => 'La clase es es requerida',
            'sector_id.required' => 'El sector de la economía es requerido',
            'subsector_id.required' => 'El subsector de la economía es requerido',
            'estado.required' => 'El estado para esta organizacion es requerido',
        ];
    }
}
