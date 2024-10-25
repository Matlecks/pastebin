<?php
declare(strict_types=1);

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;

use App\Http\Requests\UserAuthRequest;
use App\Http\Requests\UserRegRequest;

use App\Repositories\UserRepository;
use App\Services\UserService;


use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{

    protected UserService $userService;

    /**
     * UserController constructor
     * @param \App\Services\UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Страница авторизации
     * @return \Illuminate\Contracts\View\View
     */
    public function auth_page(): View
    {
        $data = $this->userService->getAuthPageData();

        return view('users.login', compact('data'));
    }

    /**
     * Аутентификация
     * @param \App\Http\Requests\UserAuthRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function auth(UserAuthRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $this->userService->authUser($validated, $request);

        return redirect()->route('paste.index');
    }

    /**
     * Страница регистрации
     * @return \Illuminate\Contracts\View\View
     */
    public function reg_page(): View
    {
        $data = $this->userService->getRegPageData();

        return view('users.register', compact('data'));
    }

    /**
     * Регистрация
     * @param \App\Http\Requests\UserRegRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registrate(UserRegRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $this->userService->regUser($validated, $request);

        return redirect()->route('paste.index');
    }


    public function destroy($id): RedirectResponse
    {
        $this->userService->deleteUserByID($id);

        return redirect()->back();
    }
}
