<?php declare(strict_types=1);

namespace App\Models;

use App\Models\Tenants\Roles\Role;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\Brand
 *
 * @property string $id
 * @property string $email
 * @property string $name
 * @property string $password
 * @property string $role_id
 * @property string $remember_token
 * @property string $email_verified_at
 * @property string $created_at
 * @property string $updated_at
 *
 * @mixin Eloquent
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasFactory;
    use HasUuids;
    use HandleDeleteExceptions;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'role_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function Role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public static function whereHasRoleName(string $roleName): Builder
    {
        return static::query()->whereHas('role', function (Builder $q) use ($roleName) {
            $q->where('name', $roleName);
        });
    }
}
