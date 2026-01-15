<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Cpf;

class IndividualRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Permitir o uso da request sem políticas
    }

    public function rules(): array
    {
        return [
            'name' => [
                'present',
                'required',
                'string', 
                'max:80',           
            ],
            'document' => [
                'present',
                'required',
                'string',
                'regex:/^\d{11}$/',
                'min:11',
                'max:11',
                new Cpf,
            ],
            'mail' => [
                'present',
                'required',
                'string',
                'email',
                'max:100',
            ],
            'phone' => [
                'present',
                'required',
                'string',
                'regex:/^\d{10,11}$/',
                'min:10',
                'max:11',
            ],
            'address' => [
                'present',
                'required',
                'string',
                'max:50',
            ],
            'number' => [
                'present',
                'required',
                'string',
                'max:10',
            ],
            'complement' => [
                'present',
                'nullable',
                'string',
                'max:20',
            ],
            'district' => [
                'present',
                'required',
                'string',
                'max:60',
            ],
            'city' => [
                'present',
                'required',
                'string',
                'max:60',
            ],
            'cep' => [
                'present',
                'required',
                'string',
                'regex:/^\d{5}-?\d{3}$/',
                'max:9',
            ],
            'state' => [
                'present',
                'required',
                'string',
                'max:2',
            ],
            'active' => [
                'present',
                'required',
                'boolean',
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'O telefone deve conter apenas números e ter 10 ou 11 dígitos.',
            'cep.regex' => 'O CEP deve estar no formato 00000-000.',
        ];
    }
}
