<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

use Illuminate\Http\JsonResponse;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e): void {
            //
        });

        $this->renderable(function (UsersNotFoundException $e, $request): JsonResponse {
            return response()->json([
                'error' => $e->getMessage(), // Вернет сообщение "Пользователи не найдены"
            ], 404); // Код ошибки 404 Not Found
        });


        $this->renderable(function (UserNotFoundException $e, $request): JsonResponse {
            return response()->json([
                'error' => $e->getMessage(), // Вернет сообщение "Пользователь не найден"
            ], 404); // Код ошибки 404 Not Found
        });

        $this->renderable(function (UserUpdateException $e, $request): JsonResponse {
            return response()->json([
                'error' => $e->getMessage(), // Вернет сообщение "Не удалось обновить пользователя"
            ], 422); // Код ошибки 422 серверу не удалось обработать инструкции содержимого
        });

        $this->renderable(function (UserStoreException $e, $request): JsonResponse {
            return response()->json([
                'error' => $e->getMessage(), // Вернет сообщение "Не удалось создать пользователя"
            ], 422); // Код ошибки 422 серверу не удалось обработать инструкции содержимого
        });

        $this->renderable(function (UserDeleteException $e, $request): JsonResponse {
            return response()->json([
                'error' => $e->getMessage(), // Вернет сообщение "Не удалось удалить пользователя"
            ], 409); // Код ошибки 409 запрос не может быть выполнен из-за конфликта с текущим состоянием ресурса
        });

        $this->renderable(function (PastesNotFoundException $e, $request): JsonResponse {
            return response()->json([
                'error' => $e->getMessage(), // Вернет сообщение "Пасты не найдены"
            ], 404); // Код ошибки 404 Not Found
        });


        $this->renderable(function (PasteNotFoundException $e, $request): JsonResponse {
            return response()->json([
                'error' => $e->getMessage(), // Вернет сообщение "Паста не найдена"
            ], 404); // Код ошибки 404 Not Found
        });

        $this->renderable(function (PasteUpdateException $e, $request): JsonResponse {
            return response()->json([
                'error' => $e->getMessage(), // Вернет сообщение "Не удалось обновить пасту"
            ], 422); // Код ошибки 422 серверу не удалось обработать инструкции содержимого
        });

        $this->renderable(function (PasteStoreException $e, $request): JsonResponse {
            return response()->json([
                'error' => $e->getMessage(), // Вернет сообщение "Не удалось создать пасту"
            ], 422); // Код ошибки 422 серверу не удалось обработать инструкции содержимого
        });

        $this->renderable(function (PasteDeleteException $e, $request): JsonResponse {
            return response()->json([
                'error' => $e->getMessage(), // Вернет сообщение "Не удалось удалить пасту"
            ], 409); // Код ошибки 409 запрос не может быть выполнен из-за конфликта с текущим состоянием ресурса
        });
    }
}
