<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Repositories\UserRepository;

use App\DTO\UserDTO;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Получить всех пользователей
     * @return JsonResponse|mixed
     */
    public function getAllUsers(): JsonResponse
    {
        $data = $this->userRepository->getAllUsers();

        return response()->json($data);
    }

    /**
     * Получить одного пользователя по ID
     * @param mixed $id
     * @return JsonResponse|mixed
     */
    public function getUserById($id): JsonResponse
    {
        $data = $this->userRepository->getUserById($id);

        if (!$data) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($data);
    }

    /**
     * Создать нового пользователя
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse|mixed
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $UserDTO = new UserDTO(
            $validated['name'],
            $validated['email'],
            $validated['banned'],
            $validated['password'],
        );

        $data = $this->userRepository->store($UserDTO);

        return response()->json($data);
    }

    /**
     * Обновить существующего пользователя
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return JsonResponse|mixed
     */
    public function update(UserUpdateRequest $request, $id): JsonResponse
    {
        $validated = $request->validated();

        $UserDTO = new UserDTO(
            $validated['name'],
            $validated['email'],
            $validated['banned'],
            $validated['password'],
        );

        $data = $this->userRepository->update($id, $UserDTO);

        return response()->json($data);
    }

    /**
     * Удалить пользователя
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function destroyUserById($id): JsonResponse
    {

        $data = $this->userRepository->destroyUserById($id);

        return response()->json($data);
    }
}
