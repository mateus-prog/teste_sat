<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Cpf implements ValidationRule
{
    /**
     * Executa a validação do CPF.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Remove tudo que não for número
        $cpf = preg_replace('/\D/', '', $value ?? '');

        // Verifica se tem 11 dígitos
        if (strlen($cpf) !== 11) {
            $fail('O campo :attribute deve conter 11 dígitos.');
            return;
        }

        // Rejeita números repetidos (ex: 11111111111)
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            $fail('O campo :attribute não é um CPF válido.');
            return;
        }

        // Calcula e valida os dígitos verificadores
        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                $fail('O campo :attribute não é um CPF válido.');
                return;
            }
        }
    }
}
