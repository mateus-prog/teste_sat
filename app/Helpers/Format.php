<?php

namespace App\Helpers;

abstract class Format {
	/**
	 * Formata uma string para um formato de telefone conhecido
	 *
	 * @param  string $number
	 * @return string
	 */
	public static function phone(string $number): string 
	{
		// Remove o que não for número
		$number = preg_replace('/\D/', '', $number);

		// Nenhum formato conhecido
		if (strlen($number) < 8) {
			return $number;
		}

		// Até 9 dígitos
		if (strlen($number) <= 9) {
			return preg_replace('/(\d{5})(\d*)/', '$1-$2', $number);
		}

		// Demais formatos
		return preg_replace('/(\d{2})(\d{5})(\d*)/', '($1) $2-$3', $number);
	}

	/**
	 * Formata uma string para um formato do CEP
	 *
	 * @param  string $number
	 * @return string
	 */
	public static function cep(string $number): string 
	{
		// Remove o que não for número
		$number = preg_replace('/\D/', '', $number);

		// Nenhum formato conhecido
		if (strlen($number) != 8) {
			return $number;
		}

		return preg_replace('/(\d{5})(\d*)/', '$1-$2', $number);
	}

	/**
	 * Coloca a string na formatação de documento(CPF)
	 *
	 * @param  string $number
	 * @return string
	 */
	public static function document(string $number): string
	{
		return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $number);
	}
}