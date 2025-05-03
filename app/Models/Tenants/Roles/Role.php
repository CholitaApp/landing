<?php declare(strict_types=1);

namespace App\Models\Tenants\Roles;

use App\Models\HandleDeleteExceptions;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Role
 *
 * @property string $id
 * @property string $name
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User|null $users
 *
 * @method static Builder|Role newModelQuery()
 * @method static Builder|Role newQuery()
 * @method static Builder|Role query()
 * @method static Builder|Role whereCreatedAt($value)
 * @method static Builder|Role whereDescription($value)
 * @method static Builder|Role whereId($value)
 * @method static Builder|Role whereName($value)
 * @method static Builder|Role whereUpdatedAt($value)
 *
 * @mixing \Eloquent
 */
class Role extends Model
{
    use HandleDeleteExceptions;

    protected $table = 'roles';

    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'description' => 'string',
    ];

    public function users(): HasMany
    {
        return $this->HasMany(User::class);
    }

    public function getName(): string
    {
        return $this->name;
    }
}
