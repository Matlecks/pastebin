<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Paste
 * @package App\Models
 */
class Paste extends Model
{
    protected $fillable = [
        'name',
        'content',
        'user_id',
        'content',
        'expires_at',
        'access_level',
        'link',
    ];

    /**
     * Связь BelongsTo с моделью User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Связь с жалобами Complaint
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Complaint, $this>
     */
    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class);
    }
}
