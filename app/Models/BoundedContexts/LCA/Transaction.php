<?php declare(strict_types=1);

namespace App\Models\BoundedContexts\LCA;

use App\Models\BoundedContexts\CholitaModel;
use App\Models\Tenants\Company;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property null|float $quantity
 * @property string $quantity_unit
 * @property string $warehouse_id
 * @property null|string $product_id
 * @property string $created_by
 * @property null|Carbon $created_at
 * @property null|Carbon $updated_at
 * @property null|string $company_id
 * @property null|string|array|object $errors
 * @property null|string $channel
 * @property Carbon $date_of_transaction
 * @property-read Product $product
 */
abstract class Transaction extends CholitaModel
{
    protected $guarded = [];

    protected $casts = [
        'date_of_transaction' => 'date',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }


}
