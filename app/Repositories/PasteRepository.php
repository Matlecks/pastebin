<?php

namespace App\Repositories;

use App\Models\Paste;
use Illuminate\Database\Eloquent\Collection;

use App\DTO\PasteDTO;

use App\Exceptions\PasteNotFoundException;
use App\Exceptions\PasteUpdateException;
use App\Exceptions\PasteStoreException;
use App\Exceptions\PasteDeleteException;
use \App\Exceptions\PastesNotFoundException;

class PasteRepository
{
    /**
     * Получить все пасты
     *
     * @return array{pastes: \Illuminate\Support\Collection<int, Paste>, status: int}
     */

    public function getAllPastes(): array
    {
        $data = ['pastes' => collect(), 'status' => 200];

        try {
            $data['pastes'] = Paste::all();
            $data['status'] = 200;

            return $data;
        } catch (PastesNotFoundException $e) {
            $data['status'] = 404;

            return $data;
        }
    }

    /**
     * Получить одну пасту по id
     *
     * @param int $id
     * @return array{paste: Paste|null, status: int}
     */
    public function getPasteById($id): array
    {
        $data = ['paste' => null, 'status' => 200];

        try {
            $data['paste'] = Paste::query()->find($id);
            $data['status'] = 200;

            return $data;
        } catch (PasteNotFoundException $e) {
            $data['status'] = 404;

            return $data;
        }
    }

    /**
     * Метод сохранения новой пасты
     * @param array $validatedData
     * @return array
     */
    public function store(PasteDTO $pasteDTO): array
    {
        try {
            Paste::create([
                'name' => $pasteDTO->name,
                'content' => $pasteDTO->content,
                'user_id' => $pasteDTO->user_id,
                'expires_at' => $pasteDTO->expires_at,
                'access_level' => $pasteDTO->expires_at,
                'language' => $pasteDTO->language,
                'link' => $pasteDTO->link,
            ]);
            $data['status'] = 200;
        } catch (PasteStoreException $e) {
            $data['status'] = 422;
            return $data;
        }

        return $data;
    }

    /**
     * Метод для обновления пасты
     * @param int $id
     * @param array $validatedData
     * @return void
     */
    public function update($id, PasteDTO $pasteDTO): array
    {
        $paste = Paste::find($id);

        if ($paste === null) {
            throw new PasteNotFoundException();
        }

        try {
            $paste->update([
                'name' => $pasteDTO->name,
                'content' => $pasteDTO->content,
                'user_id' => $pasteDTO->user_id,
                'expires_at' => $pasteDTO->expires_at,
                'access_level' => $pasteDTO->expires_at,
                'language' => $pasteDTO->language,
                'link' => $pasteDTO->link,
            ]);
            $data['status'] = 200;
        } catch (PasteUpdateException $e) {
            $data['status'] = 422;
            return $data;
        }

        return $data;
    }

    /**
     * Метод удаления пасты
     * @param int $id
     * @return array
     */
    public function destroyPasteById($id): array
    {
        $paste = Paste::find($id);

        if ($paste === null) {
            throw new PasteNotFoundException();
        }

        try {
            $paste->delete();
            $data['status'] = 200;
        } catch (PasteDeleteException $e) {
            $data['status'] = 422;
            return $data;
        }

        return $data;
    }
}
