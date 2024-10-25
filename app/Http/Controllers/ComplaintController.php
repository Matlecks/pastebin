<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ComplaintStoreRequest;

use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

use \App\Services\ComplaintService;

class ComplaintController extends Controller
{

    protected ComplaintService $complaintService;
    /**
     * ComplaintController constructor
     * @param \App\Services\ComplaintService $complaintService
     */
    public function __construct(ComplaintService $complaintService)
    {
        $this->complaintService = $complaintService;
    }

    /**
     * Страница с формой создания жалобы
     */
    public function create(): View
    {
        $data = $this->complaintService->getCreateData();

        return view('complaints.create', compact('data'));
    }

    /**
     * Сохранение жалобы
     * @param \App\Http\Requests\ComplaintStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ComplaintStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $this->complaintService->storeData($validated);

        return redirect()->route('paste.create');
    }

    /**
     * Отображение одной жалобы
     * @param mixed $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id): View {

        $data = $this->complaintService->getShowData($id);

        return view('complaints.show', compact('data'));

    }
}
