<?php declare(strict_types=1);

namespace App\Models\BoundedContexts;

use App\Models\HandleDeleteExceptions;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

abstract class CholitaModel extends Model
{
    use HasUuids;
    use HandleDeleteExceptions;

    protected $keyType = 'string';
    public $incrementing = false;
}
