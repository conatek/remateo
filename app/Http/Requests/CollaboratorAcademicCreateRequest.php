<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollaboratorAcademicCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // dd($this->request->get('certificate'));
        if($this->request->get('certificate') != "null"){
            return [
                'achievement_type_id' => 'required',
                'degree' => 'required',
                'institution' => 'required',
                'end_date' => 'date',
                'certificate' => 'max:2048|mimes:pdf',
            ];
        } else {
            return [
                'achievement_type_id' => 'required',
                'degree' => 'required',
                'institution' => 'required',
                'end_date' => 'date',
            ];
        }
    }

    public function messages(): array
    {
        return [
            'achievement_type_id.required' => 'El tipo de logro es requerido.',
            'degree.required' => 'El grado es requerido.',
            'institution' => 'La institución es requerida.',
            'end_date' => 'La fecha de finalización es requerida.',
            'certificate.max' => 'El archivo no debe ser mayor a 2MB.',
            'certificate.mimes' => 'El archivo debe ser un PDF.',
        ];
    }
}
