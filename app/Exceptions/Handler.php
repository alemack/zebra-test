<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $e): JsonResponse|Response
    {
        if ($e instanceof ValidationException) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }

        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'message' => 'Resource not found'
            ], 404);
        }

        if ($e instanceof AuthenticationException) {
            return response()->json([
                'message' => 'Unauthenticated'
            ], 401);
        }

        if ($e instanceof AuthorizationException) {
            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        }

        if (app()->environment('production')) {
            return response()->json([
                'message' => 'Internal server error'
            ], 500);
        }

        return parent::render($request, $e);
    }
}
