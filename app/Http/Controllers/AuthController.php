<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public final function login()
    {
        return view('admin.login-page');
    }

    public final function validation(Request $request): \Illuminate\Http\JsonResponse|array
    {
        try {
            $attributes = $request->validate([
                'username' => ['required'],
                'password' => ['required', 'min:3'],
            ]);
            $this->userService->validationLogin($attributes['username'], $attributes['password']);
            $response = ResponseHelper::success('Login Berhasil');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }

    public final function logout(): \Illuminate\Http\JsonResponse
    {
        try {
            Auth::logout();
            $response = ResponseHelper::success('Berhasil Logout.');
        } catch (\Exception $e) {
            $response = ResponseHelper::error($e->getMessage());
        }
        return response()->json($response);
    }
}
