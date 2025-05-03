<?php declare(strict_types=1);

namespace App\Models\Tenants;

use App\Models\BoundedContexts\CholitaModel;
use App\Models\BoundedContexts\LCA\Brand;
use App\Models\BoundedContexts\LCA\Material;
use App\Models\BoundedContexts\LCA\Product;
use App\Models\BoundedContexts\LCA\ProductWarehouse;
use App\Models\BoundedContexts\LCA\Recipe;
use App\Models\BoundedContexts\LCA\Warehouse;
use App\Models\BoundedContexts\Marketplace\Transaction\Purchase;
use App\Models\BoundedContexts\Marketplace\Transaction\Sale;
use App\Models\BoundedContexts\Reports\GeneratedReport;
use App\Models\BoundedContexts\Shared\Reports\Report;
use App\Models\BoundedContexts\Shared\Reports\ReportSubscription;
use App\Models\User;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $name
 * @property null|string $legal_representative
 * @property int $quantity_of_authorized_users
 * @property DateTimeInterface $created_at
 * @property DateTimeInterface $updated_at
 * @property bool $require_2fa
 * @property bool $has_multi_warehouse
 * @property-read User[] $users
 * @property-read Warehouse[] $warehouses
 * @property-read Brand[] $brands
 * @property-read Product[] $products
 * @property-read Material[] $materials
 * @property-read Recipe[] $recipes
 * @property-read Sale[] $sales
 * @property-read Purchase[] $purchases
 * @property-read Report[] $reports
 */

class Company extends CholitaModel
{
    protected $table = 'companies';
    protected $guarded = [];
    protected $casts = [
        'require_2fa' => 'boolean',
        'has_multi_warehouse' => 'boolean',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function warehouses(): HasMany
    {
        return $this->hasMany(Warehouse::class);
    }

    public function brands(): HasMany
    {
        return $this->hasMany(Brand::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }

    public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    public function generatedReports(): HasMany
    {
        return $this->hasMany(GeneratedReport::class);
    }

    public function productWarehouses(): HasMany
    {
        return $this->hasMany(ProductWarehouse::class);
    }

    public function companyReportSubscriptions(): HasMany
    {
        return $this->hasMany(ReportSubscription::class);
    }

    public function reports(): BelongsToMany
    {
        return $this->belongsToMany(Report::class, 'company_report_subscriptions')
            ->using(ReportSubscription::class);
    }
}
