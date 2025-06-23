<?php
    namespace App\Http\Service;

    use Illuminate\Support\Facades\Hash;

    class AuthService
    {
        public function login(array $credentials): ?string
        {
            $user = \App\Models\User::where('email', $credentials['email'])->first();

            if (!$user || !Hash::check($credentials['password'], $user->password)) {
                return null;
            }

            return $user->createToken('api-token')->plainTextToken;
        }
    }
?>
