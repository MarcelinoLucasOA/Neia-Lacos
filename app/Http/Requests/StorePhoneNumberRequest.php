<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePhoneNumberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'number' => 'required|string|max:255',
            'label' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'number.required' => 'O campo Número do Telefone é obrigatório.',
            'number.string' => 'O campo Número do Telefone deve ser um texto.',
            'number.max' => 'O campo Número do Telefone não pode exceder 255 caracteres.',

            'label.string' => 'O campo Rótulo deve ser um texto.',
            'label.max' => 'O campo Rótulo não pode exceder 255 caracteres.',
        ];
    }
}