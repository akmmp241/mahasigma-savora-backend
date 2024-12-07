<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseCode;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(
            fn(AuthenticationException $e) => response()->json([
                'message' => $e->getMessage() ?? "Unauthenticated",
                'data' => null,
                'errors' => null
            ])->setStatusCode(
                ResponseCode::HTTP_UNAUTHORIZED
            )
        );

        $exceptions->render(
            fn(ConflictHttpException $e) => response()->json([
                'message' => $e->getMessage() ?? "Conflict",
                'data' => null,
                'errors' => null
            ])->setStatusCode(
                ResponseCode::HTTP_CONFLICT
            )
        );

        $exceptions->render(
            fn(MethodNotAllowedHttpException $e) => response()->json([
                'message' => $e->getMessage() ?? "Method Not Allowed",
                'data' => null,
                'errors' => null
            ])->setStatusCode(
                ResponseCode::HTTP_METHOD_NOT_ALLOWED
            )
        );

        $exceptions->render(
            fn(NotFoundHttpException $e) => response()->json([
                'message' => $e->getMessage() ?? "Not Found",
                'data' => null,
                'errors' => null
            ])->setStatusCode(
                ResponseCode::HTTP_NOT_FOUND
            )
        );

        $exceptions->render(
            fn(UnauthorizedException $e) => response()->json([
                'message' => $e->getMessage() ?? "Unauthorized",
                'data' => null,
                'errors' => null
            ])->setStatusCode(
                ResponseCode::HTTP_UNAUTHORIZED
            )
        );

        $exceptions->render(
            fn(ValidationException $e) => response()->json([
                'message' => $e->getMessage() ?? "Failed Validation",
                'data' => null,
                'errors' => $e->errors()
            ])->setStatusCode(
                ResponseCode::HTTP_BAD_REQUEST
            )
        );

        $exceptions->render(
            fn(Exception $e) => response()->json([
                'message' => $e->getMessage() ?? "Internal Server Error",
                'data' => null,
                'errors' => null
            ])->setStatusCode(
                ResponseCode::HTTP_INTERNAL_SERVER_ERROR
            )
        );
    })->create();
