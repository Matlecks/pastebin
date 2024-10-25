<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Complaint extends Model
{
    protected $fillable = ['paste_id', 'reason']; // Заполняемые поля

    /**
     * связь с Пастами Paste
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Paste, $this>
     */
    public function paste(): BelongsTo
    {
        return $this->belongsTo(Paste::class);
    }
}
