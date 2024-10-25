<?
declare(strict_types=1);

namespace App\Services;

use App\Models\Complaint;
use App\Models\Paste;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ComplaintService
{

    public function getCreateData(): array
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
     * Метод сохранения жалобы
     * @param mixed $validated
     * @return void
     */
    public function storeData($validated): void
    {
        $complaint = Complaint::create([
            'paste_id' => $validated['paste_id'],
            'reason' => $validated['reason'],
        ]);
    }

    /**
     * Метод для отображения одной жалобы
     * @param mixed $id
     * @return array
     */
    public function getShowData($id): array
    {
        $date['complaint'] = Complaint::find($id);

        if ($date['complaint']) {
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
        } else {
            abort(404, 'Элемент не найден');
        }
    }
}
