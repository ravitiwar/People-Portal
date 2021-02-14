<?php

namespace App\Http\Controllers\Api;

use App\Auth\AuthProxy;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RefreshTokenRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $authService;

    function __construct(AuthProxy $authService)
    {
        $this->authService = $authService;

    }

    function login(LoginRequest $loginRequest)
    {
        return response()->success(
            $this->authService->login(
                $loginRequest->get('email'),
                $loginRequest->get('password')
            ), "Login successfull");
    }


    function refreshToken(RefreshTokenRequest $refreshTokenRequest)
    {
        return response()->success($this->authService->refreshToken($refreshTokenRequest->get('refresh_token')));;
    }

    function register(RegisterRequest $registerRequest)
    {
        return response()->success($this->authService->register($registerRequest->only(['name', 'email', 'password'])),
            "Registration success");
    }
}
