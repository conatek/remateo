<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampusEditRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'address' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido.',
            'address.required' => 'La dirección es requerida.',
            'province_id.required' => 'El departamento es requerido.',
            'city_id.required' => 'El municipio es requerido.',
            'phone.required' => 'El teléfono es requerido',
            'email.required' => 'El correo electrónico es requerido.',
            'email.email' => 'El email no tiene el formato adecuado.',
        ];
    }
}
