<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

use App\Exceptions\InvalidFormException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
        $middleware->api(prepend: [
            \Illuminate\Http\Middleware\HandleCors::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // ValidationException → 422
        $exceptions->renderable(function (ValidationException $e, $request) {
            if ($request->expectsJson()) {
                throw new InvalidFormException($e->errors());
            }
        });

        // HttpException (ex: 403, 404, 405, 500) → status do próprio exception
        $exceptions->renderable(function (HttpException $e, $request) {
            if ($request->expectsJson()) {
                $status = $e->getStatusCode();
                $message = match ($status) {
                    404 => 'Pagina não encontrada.',
                    405 => 'Método não permitido.',
                    500 => 'Erro interno do servidor.',
                    default => $e->getMessage() ?: 'Erro interno do servidor.',
                };

                return response()->json([
                    'message' => $message,
                    'status' => $status,
                ], $status);
            }
        });
    })->create();
