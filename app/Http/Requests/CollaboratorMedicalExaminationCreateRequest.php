<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollaboratorMedicalExaminationCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if($this->request->get('examination_result') != "null"){
            return [
                'examination_type_id' => 'required',
                'examination_date' => 'date',
                'examination_result' => 'max:2048|mimes:pdf',
            ];
        } else {
            return [
                'examination_type_id' => 'required',
                'examination_date' => 'date',
            ];
        }
    }

    public function messages(): array
    {
        return [
            'examination_type_id.required' => 'El tipo de evaluación médica es requerido.',
            'examination_date' => 'La fecha de evaluación es requerida.',
            'examination_result.max' => 'El archivo no debe ser mayor a 2MB.',
            'examination_result.mimes' => 'El archivo debe ser un PDF.',
        ];
    }
}
