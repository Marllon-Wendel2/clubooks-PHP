<?php
namespace App\Http\Controllers;

use App\Http\Service\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        $token = $this->authService->login($request->only(['email', 'password']));

        if (!$token) {
            return response()->json([
                    'success' => false,
                    'message' => $token,
                ], 401);

        }

        return response()->json([
             'success' => true,
             'token' => $token,
         ]);
    }

}

?>
