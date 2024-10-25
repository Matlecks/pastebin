<?php

namespace App\Repositories;

use App\Models\User;

use App\DTO\UserDTO;

use App\Exceptions\UserNotFoundException;
use App\Exceptions\UserUpdateException;
use App\Exceptions\UserStoreException;
use App\Exceptions\UserDeleteException;
use \App\Exceptions\UsersNotFoundException;

class UserRepository
{
    /**
     * Получить всех пользователей
     *
     * @return array{users: \Illuminate\Support\Collection<int, User>, status: int}
     */
    public function getAllUsers(): array
    {
        $data = ['users' => collect(), 'status' => 200];

        try {
            $data['users'] = User::all();
            $data['status'] = 200;

            return $data;
        } catch (UsersNotFoundException $e) {
            $data['status'] = 404;

            return $data;
        }
    }



    /**
     * Получить одного пользователя по ID
     *
     * @param int $id
     * @return array{user: User|null, status: int}
     */

    public function getUserById($id): array
    {
        $data = ['user' => null, 'status' => 200];

        try {
            $data['user'] = User::query()->find($id);
            $data['status'] = 200;

            return $data;
        } catch (UserNotFoundException $e) {
            $data['status'] = 404;

            return $data;
        }
    }

    /**
     * Метод сохранения новой записи пользователя
     *
     * @param UserDTO $userDTO
     * @return array{status: int}
     */
    public function store(UserDTO $userDTO): array
    {
        try {
            User::create([
                'name' => $userDTO->name,
                'email' => $userDTO->email,
                'password' => $userDTO->password,
                'banned' => $userDTO->banned,
            ]);
            $data['status'] = 200;
        } catch (UserStoreException $e) {
            $data['status'] = 422;
            return $data;
        }

        return $data;
    }

    /**
     * Метод для обновления записи пользователя
     *
     * @param int $id
     * @param UserDTO $userDTO
     * @return array{status: int}
     */
    public function update($id, UserDTO $userDTO): array
    {
        $user = User::find($id);

        if ($user === null) {
            throw new UserNotFoundException();
        }

        try {
            $user->update([
                'name' => $userDTO->name,
                'email' => $userDTO->email,
                'password' => $userDTO->password,
                'banned' => $userDTO->banned,
            ]);
            $data['status'] = 200;
        } catch (UserUpdateException $e) {
            $data['status'] = 422;
            return $data;
        }

        return $data;
    }

    /**
     * Метод удаления пользователя
     *
     * @param int $id
     * @return array{status: int}
     */
    public function destroyUserById($id): array
    {
        $user = User::find($id);

        if ($user === null) {
            throw new UserNotFoundException();
        }

        try {
            $user->delete();
            $data['status'] = 200;
        } catch (UserDeleteException $e) {
            $data['status'] = 422;
            return $data;
        }

        return $data;
    }
}
