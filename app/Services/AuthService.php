<?php

namespace App\Services;

use App\Models\Device;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class AuthService
{
    public function register($request)
    {
        // Create user
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate token
        $token = $user->createToken('ApiToken')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
            'message' => 'User registered successfully'
        ], 200);

    }

    public function registerBiometricData($request)
    {
        $user = auth()->user();
        // Register device
        $device = $this->createDevice($request, $user);
        if (!$device) {
            if (!$user) {
                return response()->json(['message' => 'error'], 400);
            }
        }

        return response()->json(['message' => 'biometric data saved ']);

    }

    public function createDevice($request, $user)
    {
        // Register device
        $device = Device::create([
            'user_id' => $user->id,
            'device_id' => $request->device_id,
            'is_biometric_enabled' => true
        ]);
    }

    public function biometricLogin($request)
    {
        // Find user
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Check if device is registered
        $device = Device::where([
            'user_id' => $user->id,
            'device_id' => $request->device_id,
            'is_biometric_enabled' => true
        ])->first();

        if (!$device) {
            return response()->json(['message' => 'Unauthorized device'], 403);
        }

        // Generate token
        $token = $user->createToken('BiometricToken')->accessToken;

        return response()->json([
            'token' => $token,
            'user' => $user
        ], 200);
    }

    public function login($request)
    {
        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = auth()->user()->createToken('auth_token')->accessToken;

        return response()->json([
            'token' => $token,
            'user' => auth()->user(),
        ]);
    }

    public function logout()
    {
        auth()->user()->token()->revoke();
        return response()->json(['message' => 'Logged out successfully']);
    }


}


