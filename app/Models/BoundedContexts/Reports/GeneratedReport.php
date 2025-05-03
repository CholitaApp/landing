<?php declare(strict_types=1);

namespace App\Models\BoundedContexts\Reports;

use App\Models\BoundedContexts\CholitaModel;
use App\Models\BoundedContexts\LCA\Product;
use App\Models\BoundedContexts\LCA\Warehouse;
use App\Models\BoundedContexts\Shared\Reports\Report;
use App\Models\Tenants\Company;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property string $periodicity
 * @property string $filename
 * @property string $created_by
 * @property string $warehouse_id
 * @property string $company_id
 * @property string $report_id
 * @property-read Warehouse $warehouse
 * @property-read User $createdBy
 * @property-read Report $report
 */

class GeneratedReport extends CholitaModel
{
    protected $table = 'generated_reports';

    protected $fillable = [
        'periodicity',
        'payload',
        'created_by',
        'year',
        'month',
        'company_id',
        'report_id',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public static function getAllGeneratedReportsForCompanyUserFromQuery(User $user, Builder $query): Builder
    {
        return $query->where('company_id', $user->company_id);
    }
}
