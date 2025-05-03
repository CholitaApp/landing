<?php declare(strict_types=1);

namespace App\Models\BoundedContexts\Marketplace\SupplyChain;

use App\Models\BoundedContexts\CholitaModel;
use App\Models\BoundedContexts\LCA\Product;
use App\Models\BoundedContexts\Marketplace\Transaction\ProductProvider;
use App\Models\Tenants\Company;
use App\Models\User;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $created_by
 * @property string $provider_id
 * @property string $material_id
 * @property Carbon|DateTimeInterface|null $created_at
 * @property Carbon|DateTimeInterface|null $updated_at
 * @property-read User $createdBy
 * @property-read ProductProvider[] $productProviders
 * @property-read Product[] $products
 */
class Provider extends CholitaModel
{
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function productProviders(): HasMany
    {
        return $this->HasMany(ProductProvider::class);
    }

    public function products(): BelongsToMany
    {
        return $this->BelongsToMany(Product::class)
            ->using(ProductProvider::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
