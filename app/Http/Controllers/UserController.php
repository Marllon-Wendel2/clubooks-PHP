<?php

namespace App\Http\Controllers;

use App\DTOS\UserDTO;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Number;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    public  function getAllUsers(Request $request)
    {
        $users = $this->userService->findAllUsers();

        return response()->json($users);
    }

    public function createUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $dto = new UserDTO(
            $validated['name'],
            $validated['email'],
            $validated['password']
        );

        $user = $this->userService->createUser($dto);

        return response()->json([
            'message' => 'User created successfully',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ], 201);
    }

    public function getUserById(int $id) {
        $user = $this->userService->findUserById($id);

        return response() -> json([
            'user' => [
                'name' => $user->name,
                'email' => $user->email
            ]
            ]);
    }
}
?>
