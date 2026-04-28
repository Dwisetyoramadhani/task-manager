<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthControlller extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string',
                'password' => 'required'
            ]);

            return response()->json($this->authService->register($data));
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ]);
        }
    }

    public function login(Request $request)
    {
        try {
            $data = $request->validate([
                'email' => "required",
                'password' => 'required'
            ]);

            return response()->json($this->authService->login($data));
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ]);
        }
    }

    public function logout()
    {
        try {
            $this->authService->logout(auth()->user());

            return response()->json([
                'message' => 'logged out'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ]);
        }
    }
}
