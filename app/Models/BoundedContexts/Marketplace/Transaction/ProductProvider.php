<?php declare(strict_types=1);

namespace App\Models\BoundedContexts\Marketplace\Transaction;

use App\Models\BoundedContexts\LCA\Product;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property string $id
 * @property string $provider_id
 * @property string $product_id
 * @property Carbon|DateTimeInterface|null $created_at
 * @property Carbon|DateTimeInterface|null $updated_at
 * @property-read Provider $provider
 * @property-read Product $product
 */
class ProductProvider extends Pivot
{
    use HasUuids;

    protected $table = 'product_provider';

    protected $keyType = 'string';
    public $incrementing = false;

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
