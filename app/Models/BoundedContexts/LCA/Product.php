<?php declare(strict_types=1);

namespace App\Models\BoundedContexts\LCA;

use App\Models\BoundedContexts\CholitaModel;
use App\Models\BoundedContexts\Marketplace\Transaction\ProductProvider;
use App\Models\BoundedContexts\Marketplace\Transaction\Purchase;
use App\Models\BoundedContexts\Marketplace\Transaction\Sale;
use App\Models\Tenants\Company;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $name
 * @property string $sku
 * @property null|string $sku_external
 * @property float $minimal_sellable_quantity
 * @property string $source
 * @property null|string $category_1
 * @property null|string $category_2
 * @property null|string $category_3
 * @property null|string $category_4
 * @property null|float $mass
 * @property null|string $mass_unit
 * @property null|float $length
 * @property null|float $width
 * @property null|float $height
 * @property null|string $dimension_unit
 * @property null|float|int $volume
 * @property null|string $volume_unit
 * @property null|string $brand_id
 * @property string $created_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $company_id
 * @property null|array $errors
 * @property-read Brand $brand
 * @property-read Company $company
 * @property-read Warehouse[] $warehouses
 *
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 */

class Product extends CholitaModel
{
    protected $table = 'products';
    protected $guarded = [];
    protected array $cast = [
        'errors' => 'array',
        'mass' => 'float',
        'length' => 'float',
        'width' => 'float',
        'height' => 'float',
        'volume' => 'float',
        'category_1' => 'string',
        'category_2' => 'string',
        'category_3' => 'string',
        'category_4' => 'string',
    ];


    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function materials(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'recipes');
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class);
    }

    public function productProviders(): HasMany
    {
        return $this->hasMany(ProductProvider::class);
    }
}
