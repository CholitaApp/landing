<?php declare(strict_types=1);

namespace App\Models\BoundedContexts\LCA;

use App\Models\BoundedContexts\CholitaModel;
use App\Models\BoundedContexts\Marketplace\Transaction\Purchase;
use App\Models\BoundedContexts\Marketplace\Transaction\Sale;
use App\Models\BoundedContexts\Reports\GeneratedReport;
use App\Models\Tenants\Company;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $name
 * @property null|string $state
 * @property null|string $address
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property string $company_id
 * @property string $created_by
 * @property string $rep_id
 * @property null|string $sinader_id
 * @property string $related_warehouse_rep_id
 * @property-read User $creator
 * @property-read Company $company
 * @property-read Product[] $products
 * @property-read Sale[] $sales
 * @property-read Purchase[] $purchases
 */

class Warehouse extends CholitaModel
{

    protected $table = 'warehouses';
    protected $guarded = [];
    protected $fillable = [
        'name',
        'state',
        'address',
        'status',
        'company_id',
        'created_by',
        'type',
        'rep_id',
        'sinader_id',
        'related_warehouse_rep_id',
    ];

    public static function uriKey(): string
    {
        return 'warehouses';
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function productWarehouses(): HasMany
    {
        return $this->hasMany(ProductWarehouse::class);
    }

    public function generatedReports(): HasMany
    {
        return $this->HasMany(GeneratedReport::class);
    }
}
