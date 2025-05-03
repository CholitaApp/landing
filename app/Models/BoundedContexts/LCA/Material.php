<?php declare(strict_types=1);

namespace App\Models\BoundedContexts\LCA;

use App\Models\BoundedContexts\CholitaModel;
use App\Models\Tenants\Company;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $name
 * @property string $sku
 * @property float|null $price
 * @property string|null $currency
 * @property null|float $mass
 * @property string $mass_unit
 * @property int $is_domiciliary
 * @property int $is_dangerous
 * @property int $is_returnable
 * @property string|null $layer
 * @property string|null $category
 * @property string|null $subcategory
 * @property string $recycled_quantity
 * @property string|null $year_of_report
 * @property string $created_by
 * @property string $company_id
 * @property Carbon $valid_from
 * @property Carbon $valid_to
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $is_recyclable
 * @property string|null $destination
 * @property string|null $characteristic
 * @property float|null $length
 * @property float|null $width
 * @property float|null $height
 * @property string|null $dimension_unit
 * @property float|null $volume
 * @property string|null $volume_unit
 * @property float|null $unit_cost
 * @property string|null $plastic7_composition
 * @property-read User $createdBy
 * @property-read Product[] $products
 * @property-read Recipe[] $recipes
 */
class Material extends CholitaModel
{
    protected $fillable = [
        'name',
        'sku',
        'price',
        'currency',
        'mass',
        'mass_unit',
        'category',
        'subcategory',
        'characteristic',
        'recycled_quantity',
        'year_of_report',
        'created_by',
        'created_at',
        'updated_at',
        'destination',
        'length',
        'width',
        'height',
        'dimension_unit',
        'volume',
        'volume_unit',
        'unit_cost',
        'plastic7_composition',
        'valid_from',
        'valid_to',

    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'recipes');
    }

}
