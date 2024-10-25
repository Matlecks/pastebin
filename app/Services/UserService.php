<?
declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Models\Paste;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Страница авторизации
     * @return array
     */
    public function getAuthPageData(): array
    {
        if (Auth::check()) {
            $data['user_pastes'] = Paste::where('user_id', Auth::user()->id)
                ->where('expires_at', '>', now())
                ->limit(10)
                ->get();
        } else {
            $data['user_pastes'] = null;
        }

        $data['public_pastes'] = Paste::where('access_level', 'public')
            ->where('expires_at', '>', now())
            ->get();

        return $data;
    }

    /**
     * Аутентификация
     * @param mixed $validated
     * @param mixed $request
     * @return void
     */
    public function authUser($validated, $request): void
    {
        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
        }
    }

    /**
     * Страница регистрации
     * @return array
     */
    public function getRegPageData(): array
    {
        if (Auth::check()) {
            $data['user_pastes'] = Paste::where('user_id', Auth::user()->id)
                ->where('expires_at', '>', now())
                ->limit(10)
                ->get();
        } else {
            $data['user_pastes'] = null;
        }

        $data['public_pastes'] = Paste::where('access_level', 'public')
            ->where('expires_at', '>', now())
            ->get();

        return $data;
    }

    /**
     * Регистрация
     * @param mixed $validated
     * @param mixed $request
     * @return void
     */
    public function regUser($validated, $request): void
    {
        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => 2,
        ]);

        if ($user) {
            Auth::login($user);
        }
    }

    public function deleteUserByID($id)
    {
        $user = User::find($id);
        $user->delete();
    }
}
