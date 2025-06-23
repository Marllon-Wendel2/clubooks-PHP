<?php
    namespace App\Http\Service;

    use App\Models\User;
    use Illuminate\Support\Facades\Hash;
    use App\DTOS\UserDTO;
    use Illuminate\Validation\ValidationException;
    use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

    class UserService
    {
        public function createUser(UserDTO $dto): User
        {
            try {
                    return User::create([
                        'name' => $dto->name,
                        'email' => $dto->email,
                        'password' => Hash::make($dto->password),
                    ]);
                } catch (\Illuminate\Database\QueryException $e) {
                    // Aqui você pode capturar erros relacionados ao banco de dados
                    throw new ValidationException('Erro ao criar o usuário.', 400);
                } catch (\Exception $e) {
                    // Captura qualquer outro erro não esperado
                    throw new \Exception('Ocorreu um erro inesperado.', 500);
                }
        }

        public function findAllUsers() : Collection  {
            return User::all();
        }

        public function findUserById(int $id): User {
            return User::findOrFail($id);
        }

        public function updateUserById(int $id, array $data) {
            $user = User::find($id);

            if (!$user) {
                throw new \Exception('Usário com id $id não encontrado.');
            }

            return $user->update($data);
        }

        public function deleteUserById(int $id) {
            $user = User::findOrFail($id);

            return $user->delete();
        }

    }
?>
