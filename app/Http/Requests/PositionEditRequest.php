<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PositionEditRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'area_id' => 'required',
            'criticality_level_id' => 'required',
            'risk_class_id' => 'required',
            'name' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'area_id.required' => 'El área es requerida.',
            'criticality_level_id.required' => 'El nivel de criticidad es requerido.',
            'risk_class_id.required' => 'La clase de riesgo es requerida.',
            'name.required' => 'El nombre de cargo es requerido.',
        ];
    }
}
