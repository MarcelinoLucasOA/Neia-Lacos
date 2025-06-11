<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'complement' => 'nullable|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255|size:2',
            'zip_code' => 'required|string|max:255',
            'label' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'street.required' => 'O campo Rua é obrigatório.',
            'street.string' => 'O campo Rua deve ser um texto.',
            'street.max' => 'O campo Rua não pode exceder 255 caracteres.',

            'number.required' => 'O campo Número do Endereço é obrigatório.',
            'number.string' => 'O campo Número do Endereço deve ser um texto.',
            'number.max' => 'O campo Número do Endereço não pode exceder 255 caracteres.',

            'complement.string' => 'O campo Complemento deve ser um texto.',
            'complement.max' => 'O campo Complemento não pode exceder 255 caracteres.',

            'neighborhood.required' => 'O campo Bairro é obrigatório.',
            'neighborhood.string' => 'O campo Bairro deve ser um texto.',
            'neighborhood.max' => 'O campo Bairro não pode exceder 255 caracteres.',

            'city.required' => 'O campo Cidade é obrigatório.',
            'city.string' => 'O campo Cidade deve ser um texto.',
            'city.max' => 'O campo Cidade não pode exceder 255 caracteres.',

            'state.required' => 'O campo Estado é obrigatório.',
            'state.string' => 'O campo Estado deve ser um texto.',
            'state.max' => 'O campo Estado não pode exceder 255 caracteres.',
            'state.size' => 'O campo Estado deve ter exatamente 2 caracteres (sigla do estado, ex: SP, MG).',

            'zip_code.required' => 'O campo CEP é obrigatório.',
            'zip_code.string' => 'O campo CEP deve ser um texto.',
            'zip_code.max' => 'O campo CEP não pode exceder 255 caracteres.',

            'label.string' => 'O campo Rótulo do Endereço deve ser um texto.',
            'label.max' => 'O campo Rótulo do Endereço não pode exceder 255 caracteres.',
        ];
    }
}