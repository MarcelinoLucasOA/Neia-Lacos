<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo Nome é obrigatório.',
            'name.string' => 'O campo Nome deve ser um texto.',
            'name.max' => 'O campo Nome não pode exceder 255 caracteres.',

            'notes.string' => 'O campo Notas deve ser um texto.',
        ];
    }
}