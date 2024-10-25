<?
declare(strict_types=1);

namespace App\Services;

use App\Models\Paste;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PasteService
{
    /**
     * Отдает данные на страницу со списком паст пользователя
     * @return array
     */
    public function getIndexData(): array
    {
        $data['pastes'] = Paste::where('expires_at', '>', now())->paginate(10);

        $data['public_pastes'] = Paste::where('access_level', 'public')
            ->where('expires_at', '>', now())
            ->limit(10)
            ->get();

        if (Auth::check()) {
            $data['user_pastes'] = Paste::where('user_id', Auth::user()->id)
                ->where('expires_at', '>', now())
                ->limit(10)
                ->get();
        } else {
            $data['user_pastes'] = null;
        }

        return $data;
    }

    /**
     * Отдает данные на страницу создания пасты
     * @return array
     */
    public function getCreateData(): array
    {
        $data['public_pastes'] = Paste::where('access_level', 'public')
            ->where('expires_at', '>', now())
            ->get();

        if (Auth::check()) {
            $data['user_pastes'] = Paste::where('user_id', Auth::user()->id)
                ->where('expires_at', '>', now())
                ->limit(10)
                ->get();
        } else {
            $data['user_pastes'] = null;
        }

        return $data;
    }

    /**
     * Сохраняет пасту
     * @param mixed $validated
     * @return void
     */
    public function storeData($validated): void
    {
        switch ($validated['expires_at']) {
            case 1:
                $newDateTime = Carbon::now()->addMinutes(10)->format('Y-m-d H:i:s');
                break;
            case 2:
                $newDateTime = Carbon::now()->addMinutes(60)->format('Y-m-d H:i:s');
                break;
            case 3:
                $newDateTime = Carbon::now()->addMinutes(180)->format('Y-m-d H:i:s');
                break;
            case 4:
                $newDateTime = Carbon::now()->addDay()->format('Y-m-d H:i:s');
                break;
            case 5:
                $newDateTime = Carbon::now()->addWeek()->format('Y-m-d H:i:s');
                break;
            case 6:
                $newDateTime = Carbon::now()->addMonth()->format('Y-m-d H:i:s');
                break;
            case 7:
                $newDateTime = null;
                break;
            default:
                $newDateTime = null;
                break;
        }
        $validated['expires_at'] = $newDateTime;

        $validated['link'] = Str::random(12);


        if (Auth::check()) {
            $validated['user_id'] = Auth::user()->id;
        } else {
            $validated['user_id'] = null;
        }

        Paste::create($validated);
    }

    /**
     * Отдает данные на страницу показа одной пасты
     * @param mixed $link
     * @return array
     */
    public function getShowData($link): array
    {
        $date['paste'] = Paste::where('link', $link)->first();

        if ($date['paste']) {
            if ($date['paste']->expires_at < now()) {
                echo 'Время пасты истекло';
            } else {
                $date['public_pastes'] = Paste::where('access_level', 'public')
                    ->where('expires_at', '>', now())
                    ->get();
                if (Auth::check()) {
                    $date['user_pastes'] = Paste::where('user_id', Auth::user()->id)
                        ->where('expires_at', '>', now())
                        ->limit(10)
                        ->get();
                } else {
                    $date['user_pastes'] = null;
                }

                return $date;
            }
        } else {
            abort(404, 'Элемент не найден');
        }
    }
}
