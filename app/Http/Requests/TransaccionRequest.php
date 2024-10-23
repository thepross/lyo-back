<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TransaccionRequest extends FormRequest
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
        return [
            'detalle' => ['required'],
            'monto' => ['required', 'numeric', 'min:1'],
            'id_billetera_salida' => ['required'],
            'id_billetera_entrada' => ['required', 'different:id_billetera_salida'],
        ];
    }

    public function messages(): array
    {
        return [
            'monto.min' => 'El monto minimo es de 1.00',
            'id_billetera_entrada.different' => 'La billetera que recibe debe ser diferente.'
        ];
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
