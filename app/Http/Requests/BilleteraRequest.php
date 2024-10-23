<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BilleteraRequest extends FormRequest
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
        //'detalle', 'fecha', 'saldo', 'id_usuario'
        return [
            'detalle' => ['required', 'string', 'max:255'],
            'id_usuario' => ['required', ''],
        ];
    }

    public function messages(): array
    {
        return [];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Error en la validación.',
                'errors' => $validator->errors()
            ], 422)
        );
    }
}
