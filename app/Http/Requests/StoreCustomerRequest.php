<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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

            'phone_number' => 'nullable|string|max:255',
            'phone_label' => 'nullable|string|max:255',

            'address_street' => 'nullable|string|max:255',
            'address_number' => 'nullable|string|max:255',
            'address_complement' => 'nullable|string|max:255',
            'address_neighborhood' => 'nullable|string|max:255',
            'address_city' => 'nullable|string|max:255',
            'address_state' => 'nullable|string|max:255|size:2',
            'address_zip_code' => 'nullable|string|max:255',
            'address_label' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo Nome é obrigatório.',
            'name.string' => 'O campo Nome deve ser um texto.',
            'name.max' => 'O campo Nome não pode exceder 255 caracteres.',

            'notes.string' => 'O campo Notas deve ser um texto.',

            'phone_number.string' => 'O campo Número de Telefone deve ser um texto.',
            'phone_number.max' => 'O campo Número de Telefone não pode exceder 255 caracteres.',
            'phone_label.string' => 'O campo Rótulo do Telefone deve ser um texto.',
            'phone_label.max' => 'O campo Rótulo do Telefone não pode exceder 255 caracteres.',

            'address_street.string' => 'O campo Rua deve ser um texto.',
            'address_street.max' => 'O campo Rua não pode exceder 255 caracteres.',
            'address_number.string' => 'O campo Número do Endereço deve ser um texto.',
            'address_number.max' => 'O campo Número do Endereço não pode exceder 255 caracteres.',
            'address_complement.string' => 'O campo Complemento deve ser um texto.',
            'address_complement.max' => 'O campo Complemento não pode exceder 255 caracteres.',
            'address_neighborhood.string' => 'O campo Bairro deve ser um texto.',
            'address_neighborhood.max' => 'O campo Bairro não pode exceder 255 caracteres.',
            'address_city.string' => 'O campo Cidade deve ser um texto.',
            'address_city.max' => 'O campo Cidade não pode exceder 255 caracteres.',
            'address_state.string' => 'O campo Estado deve ser um texto.',
            'address_state.max' => 'O campo Estado não pode exceder 255 caracteres.',
            'address_state.size' => 'O campo Estado deve ter exatamente 2 caracteres (ex: SP, MG).',
            'address_zip_code.string' => 'O campo CEP deve ser um texto.',
            'address_zip_code.max' => 'O campo CEP não pode exceder 255 caracteres.',
            'address_label.string' => 'O campo Rótulo do Endereço deve ser um texto.',
            'address_label.max' => 'O campo Rótulo do Endereço não pode exceder 255 caracteres.',
        ];
    }
}