<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePhoneNumberRequest extends FormRequest
{
    public function authorize(): bool
    {
        $customer = $this->route('customer');
        $phoneNumber = $this->route('phone_number');

        return $phoneNumber && $phoneNumber->customer_id === $customer->id;
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

    protected function failedValidation(Validator $validator)
    {
        $customerId = $this->route('customer')->id;
        $editedPhoneId = $this->route('phone_number')->id;

        throw new HttpResponseException(
            redirect()->route('customers.show', $customerId)->withErrors($validator)->withInput()->with('edited_phone_id', $editedPhoneId)->with('error', 'Houve um erro na validação do telefone. Verifique os campos.')
        );
    }
}
