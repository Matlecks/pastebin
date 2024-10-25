<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Repositories\PasteRepository;

use App\DTO\PasteDTO;

use App\Http\Requests\PasteStoreRequest;
use App\Http\Requests\PasteUpdateRequest;

use Illuminate\Http\JsonResponse;

class PasteController extends Controller
{
    protected PasteRepository $pasteRepository;

    public function __construct(PasteRepository $pasteRepository)
    {
        $this->pasteRepository = $pasteRepository;
    }

    /**
     * Получить все пасты
     * @return JsonResponse|mixed
     */
    public function getAllPastes(): JsonResponse
    {
        $data = $this->pasteRepository->getAllPastes();

        return response()->json($data);
    }

    /**
     * Получить одного пасту
     * @param mixed $id
     * @return JsonResponse|mixed
     */
    public function getPasteById($id): JsonResponse
    {
        $data = $this->pasteRepository->getPasteById($id);

        if (!$data) {
            return response()->json(['error' => 'Paste not found'], 404);
        }

        return response()->json($data);
    }

    /**
     * Создать новую пасту
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse|mixed
     */
    public function store(PasteStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $PasteDTO = new PasteDTO(
            $validated['name'],
            $validated['content'],
            $validated['user_id'],
            $validated['expires_at'],
            $validated['access_level'],
            $validated['language'],
            $validated['link'],
        );

        $data = $this->pasteRepository->store($PasteDTO);

        return response()->json($data);
    }

    /**
     * Обновить существующую пасту
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return JsonResponse|mixed
     */
    public function update(PasteUpdateRequest $request, $id): JsonResponse
    {
        $validated = $request->validated();

        $PasteDTO = new PasteDTO(
            $validated['name'],
            $validated['content'],
            $validated['user_id'],
            $validated['expires_at'],
            $validated['access_level'],
            $validated['language'],
            $validated['link'],
        );

        $data = $this->pasteRepository->update($id, $PasteDTO);

        return response()->json($data);
    }

    /**
     * Удалить пасту
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function destroyPasteById($id): JsonResponse
    {

        $data = $this->pasteRepository->destroyPasteById($id);

        return response()->json($data);
    }
}
