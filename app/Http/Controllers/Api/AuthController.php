<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\BiometricLoginRequest;
use App\Http\Requests\Api\Auth\BiometricRegisterRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    private $AuthService;

    public function __construct(AuthService $AuthService)
    {
        $this->AuthService = $AuthService;
    }

    public function register(RegisterRequest $request)
    {
        return $this->AuthService->register($request);
    }

    public function login(LoginRequest $request)
    {
        return $this->AuthService->login($request);
    }

    public function biometricLogin(BiometricLoginRequest $request)
    {
        return $this->AuthService->biometricLogin($request);
    }

    public function biometricRegister(BiometricRegisterRequest $request)
    {
        return $this->AuthService->registerBiometricData($request);
    }

    public function logout(Request $request)
    {
        return $this->AuthService->logout();
    }
}
