<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\PasteStoreRequest;

use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

use App\Services\PasteService;

class PasteController extends Controller
{

    /**
     * Сервис для работы с пастами
     *
     * @var \App\Services\PasteService
     */
    protected PasteService $pasteService;

    /**
     * PasteController constructor
     *
     * @param \App\Services\PasteService $pasteService
     */
    public function __construct(PasteService $pasteService)
    {
        $this->pasteService = $pasteService;
    }



    /**
     * Страница со списком паст пользователя
     */
    public function index(): View
    {
        $data = $this->pasteService->getIndexData();
        return view('pastes.index', compact('data'));
    }


    /**
     * Главная страница с формой создания.
     */
    public function create(): View
    {
        $data = $this->pasteService->getCreateData();
        return view('pastes.create', compact('data'));
    }


    /**
     * Сохранение пасты
     */
    public function store(PasteStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $this->pasteService->storeData($validated);
        return redirect()->back();
    }

    /**
     * Страница показа одной пасты
     */
    public function show(string $link): View
    {
        $data = $this->pasteService->getShowData($link);
        return view('pastes.show', compact('data'));
    }
}
