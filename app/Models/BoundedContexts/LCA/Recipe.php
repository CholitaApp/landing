<?php declare(strict_types=1);

namespace App\Models\BoundedContexts\LCA;

use App\Models\BoundedContexts\CholitaModel;
use App\Models\Tenants\Company;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 * @property string $product_id
 * @property string $material_id
 * @property string $functional_unit
 * @property float $magnitude
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property Carbon|null $valid_from
 * @property Carbon|null $valid_to
 * @property string $created_by
 * @property bool $is_domiciliary
 * @property bool $is_returnable
 * @property bool $is_dangerous
 * @property bool $is_recyclable
 * @property string $company_id
 * @property string $warehouse_id
 * @property string $backyard
 * @property string $layer
 * @property string $destination
 * @property float $materials_per_product
 * @property-read User $createdBy
 * @property-read Warehouse $warehouse
 * @property-read Product $product
 * @property-read Material $material
 * @property-read Company $company
 */

class Recipe extends CholitaModel
{
    use SoftDeletes;

    protected $table = 'recipes';
    protected $guarded = [];
    protected $fillable = [
        'product_id',
        'material_id',
        'warehouse_id',
        'layer',
        'is_domiciliary',
        'is_returnable',
        'is_dangerous',
        'is_recyclable',
        'valid_from',
        'valid_to',
        'active',
        'functional_unit',
        'magnitude',
        'materials_per_product',
        'created_by',
        'backyard',
        'destination',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'is_domiciliary' => 'boolean',
        'is_returnable' => 'boolean',
        'is_dangerous' => 'boolean',
        'is_recyclable' => 'boolean',
        'materials_per_product' => 'float',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public static function getProductAndUserRecipe(int $userId, ?Product $product, ?Material $material): ?Recipe
    {
        if ($product && $material && $userId) {
            return Recipe::query()->
            where([
                'product_id' => $product->id,
                'material_id' => $material->id,
                'created_by' => $userId,
            ])->first();
        }
        return null;
    }
}
