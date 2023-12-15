<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'direccion' => ['required', 'string ', 'max:255'],
            'telefono' => ['required', 'string', 'unique:usuarios', 'min:7', 'max:10'],
            'tipo' => ['integer', 'min:0', 'max:3'],
        ];
        return $rules;
    }

    public function messages(): array
    {
        return [
            'nombres.required' => 'El nombre es requerido.',
            'nombres.string' => 'El nombre solo puede contener letras.',
            'nombres.max' => 'Maximo 255 caracteres.',
            'apellidos.required' => 'El apellido es requerido.',
            'apellidos.string' => 'El apellido solo puede contener letras.',
            'apellidos.max' => 'Maximo 255 caracteres.',
            'direccion.required' => 'La dirección es requerido.',
            'direccion.string' => 'La dirección solo puede contener letras.',
            'direccion.max' => 'Maximo 255 caracteres.',
            'telefono.required' => 'El telefono es requerido.',
            'telefono.string' => 'El telefono solo puede contener letras.',
            'telefono.unique' => 'El telefono ya está registrado.',
            'telefono.min' => 'Minimo 7 caracteres.',
            'telefono.max' => 'Maximo 10 caracteres.',
            'tipo.integer' => 'Solo numeros [0, 1, 2, 3].',
            'tipo.min' => 'Tipo invalido >= 0.',
            'tipo.max' => 'Tipo invalido <= 3.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Error en la validación.',
                'errors' => $validator->errors()
            ], 422));
    }
}
