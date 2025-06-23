<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use Illuminate\Http\JsonResponse;

class Handler extends ExceptionHandler
{
    protected $levels = [
        // Define níveis de log por tipo de exceção, se quiser
    ];

    protected $dontReport = [
        // Adicione aqui exceções que não quer registrar
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // Log customizado (opcional)
        });
    }

    public function render($request, Throwable $exception): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => 'Erro inesperado na requisição.',
            'error' => $exception->getMessage(), // em produção, remova se quiser esconder
        ], $this->getStatusCode($exception));
    }


    protected function getStatusCode(Throwable $e): int
    {
        if ($e instanceof HttpException) {
            return $e->getStatusCode();
        }

        return 500;
    }
}
