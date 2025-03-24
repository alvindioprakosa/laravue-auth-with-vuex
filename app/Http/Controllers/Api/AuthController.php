<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
    /**
     * Login API
     */
    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        // Autentikasi pengguna
        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->sendError('Unauthorized.', ['error' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('MyApp')->accessToken;

        return $this->sendResponse([
            'token' => $token,
            'name' => $user->name
        ], 'User login successfully.');
    }

    /**
     * Logout API
     */
    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            // Revoke semua token aktif user
            $user->tokens()->delete();
            return $this->sendResponse([], 'User logged out successfully.');
        }

        return $this->sendError('Unauthenticated.', [], 401);
    }
}
