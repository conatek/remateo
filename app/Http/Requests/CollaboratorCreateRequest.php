<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollaboratorCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image' => 'required|image|mimes:jpeg,png,jpg|dimensions:max_width=200,max_height=200|max:100',
            'name' => 'required',
            'first_surname' => 'required',
            'second_surname' => 'required',
            'document_type_id' => 'required',
            'document_number' => 'required',
            'document_province_id' => 'required',
            'document_city_id' => 'required',
            'expedition_date' => 'required',
            'birth_province_id' => 'required',
            'birth_city_id' => 'required',
            'birth_date' => 'required',
            'sex_type_id' => 'required',
            'rh_type_id' => 'required',
            'scholarship_type_id' => 'required',
            'observations' => '',
            'residence_province_id' => 'required',
            'residence_city_id' => 'required',
            'stratum_type_id' => 'required',
            'address' => 'required',
            'phone' => '',
            'cellphone' => 'required',
            'email' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'image.required' => 'El campo foto es requerido.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.mimes' => 'Formato de imagen no admitido (usar jpeg, jpg, png).',
            'image.dimensions' => 'Las dimensiones maximas de imagen son 200 x 200',
            'image.max' => 'El archivo excede el tamaño permitido (100KB).',
            'name.required' => 'El campo nombre(s) es requerido.',
            'first_surname.required' => 'El campo primer apellido es requerido.',
            'document_type_id.required' => 'El campo tipo de documento es requerido.',
            'document_number.required' => 'El campo número de documento es requerido.',
            'document_province_id.required' => 'El campo departamento de expedición es requerido.',
            'document_city_id.required' => 'El campo municipio de expedición es requerido.',
            'expedition_date.required' => 'El campo fecha de expedición es requerido.',
            'birth_province_id' => 'El campo departamento de nacimiento es requerido.',
            'birth_city_id' => 'El campo municipio de nacimiento es requerido.',
            'birth_date' => 'El campo fecha de nacimiento es requerido.',
            'sex_type_id' => 'El campo sexo es requerido.',
            'rh_type_id' => 'El campo rh es requerido.',
            'scholarship_type_id' => 'El campo escolaridad es requerido.',
            'observations' => '',
            'residence_province_id' => 'El campo departamento de residencia es requerido.',
            'residence_city_id' => 'El campo municipio de residencia es requerido.',
            'stratum_type_id' => 'El campo estrato social es requerido.',
            'address' => 'El campo dirección es requerido.',
            'phone' => '',
            'cellphone' => 'El campo celular es requerido.',
            'email' => 'El campo correo electrónico es requerido.',
        ];
    }
}
