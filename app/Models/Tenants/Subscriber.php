<?php declare(strict_types=1);

namespace App\Models\Tenants;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Brand
 *
 * @property string $id
 * @property string $email
 *
 * @mixin Eloquent
 */
class Subscriber extends Model
{
    use HasUuids;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'email',
    ];

    public $timestamps = true;
    protected $table = 'subscribers';
}
