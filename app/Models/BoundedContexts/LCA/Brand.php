<?php declare(strict_types=1);

namespace App\Models\BoundedContexts\LCA;

use App\Models\BoundedContexts\CholitaModel;
use App\Models\Tenants\Company;
use App\Models\User;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Brand
 *
 * @property string $id
 * @property string $name
 * @property string $created_by
 * @property string $logo
 * @property int $status
 * @property string $company_id
 * @property-read User $createdBy
 * @property-read Company $company
 * @property-read Product[] $products
 *
 * @method static Builder|Brand newModelQuery()
 * @method static Builder|Brand newQuery()
 * @method static Builder|Brand query()
 *
 * @mixin Eloquent
 */

class Brand extends CholitaModel
{
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
