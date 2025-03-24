<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('username', 'password');

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Identifiants invalides'], 401);
        }

        $user = Auth::guard('api')->user();

        $access = $token;

        $refresh = JWTAuth::customClaims([
            'token_type' => 'refresh'
        ])->fromUser($user);

        return response()->json([
            'refresh' => $refresh,
            'access' => $access,
        ]);
    }

    public function refresh(Request $request): JsonResponse
    {
        try {
            $newToken = Auth::guard('api')->refresh();
            return response()->json([
                'access' => $newToken,
            ]);
        } catch (Exception) {
            return response()->json(['error' => 'Token invalide ou expiré'], 401);
        }
    }

    protected function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'access' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60,
        ]);
    }
}
