<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response as ResponseCode;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $requests = $request->validated();

        if (!$user = User::query()->where('email', $requests['email'])->first())
            throw new UnauthorizedException('Invalid credentials');

        if (!password_verify($requests['password'], $user->password))
            throw new UnauthorizedException('Invalid credentials');

        auth()->login($user);

        $token = $user->createToken('auth_token')->plainTextToken;

        $payload = [
            'token' => $token,
            'user' => $user
        ];

        return $this->successResponse(
            message: 'Login successful',
            data: $payload
        );
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $requests = $request->validated();

        if (User::query()->where('email', $requests['email'])->exists())
            throw new ConflictHttpException('Email already exists');

        $user = User::query()->create($requests);

        auth()->login($user);

        $token = $user->createToken('auth_token')->plainTextToken;

        $payload = [
            'token' => $token,
            'user' => $user
        ];

        return $this->successResponse(
            message: 'Registration successful',
            data: $payload,
            code: ResponseCode::HTTP_CREATED
        );
    }

    public function get(): JsonResponse
    {
        $payload = [
            'user' => auth()->user()
        ];

        return $this->successResponse(
            message: 'User details',
            data: $payload
        );
    }

    public function logout(): JsonResponse
    {
        User::query()->first(
            auth()->id()
        )->tokens()->delete();

        return $this->successResponse(
            message: 'Logout successful'
        );
    }
}
