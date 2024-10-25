<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'banned',
        'role_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'permissions'          => 'array',
        'email_verified_at'    => 'datetime',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array<int, string>
     */
    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
    ];

    /**
     * Полностью удаляет все связанные Paste
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::deleting(function ($user): void {
            $user->pastes()->forceDelete();
        });
    }

    /**
     * Связь BelongsTo с моделью Paste
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Paste, $this>
     */
    public function pastes(): HasMany
    {
        return $this->hasMany(Paste::class);
    }
}
