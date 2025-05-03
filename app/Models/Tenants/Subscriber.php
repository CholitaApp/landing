<?php declare(strict_types=1);

namespace App\Models\Tenants;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Brand
 *
 * @property string $email
 *
 * @mixin Eloquent
 */
class Subscriber extends Model
{
    protected $fillable = [
        'email',
    ];

    public $timestamps = true;
    protected $table = 'subscribers';
}
