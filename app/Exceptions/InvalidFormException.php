<?php
namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class InvalidFormException extends Exception
{
    protected array $errors;

    public function __construct(array $errors, string $message = 'Erro de validação')
    {
        parent::__construct($message, Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->errors = $errors;
    }

    public function render($request)
    {
        return response()->json([
            'message' => $this->getMessage(),
            'errors'  => $this->errors,
            'status'  => Response::HTTP_UNPROCESSABLE_ENTITY
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}