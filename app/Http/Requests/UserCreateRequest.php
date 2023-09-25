<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'company_id' => 'required',
            'password' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|dimensions:max_width=200,max_height=200|max:100',
        ];
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array<string, string>
    */
    public function messages(): array
    {
        return [
            'name.required' => 'El campo nombre es requerido.',
            'email.required' => 'El campo email es requerido.',
            'email.email' => 'El campo email no tiene el formato adecuado.',
            'email.unique' => 'El email ya se encuentra registrado.',
            'company_id.required' => 'El campo empresa es requerido.',
            'password.required' => 'El campo contraseña es requerido.',
            'image.dimensions' => 'Las dimensiones maximas de imagen son 200 x 200',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.mimes' => 'Formato de imagen no admitido (usar jpeg, jpg, png).',
            'image.max' => 'El archivo excede el tamaño permitido (100KB).',
        ];
    }
}
