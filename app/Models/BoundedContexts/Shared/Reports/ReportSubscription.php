<?php declare(strict_types=1);

namespace App\Models\BoundedContexts\Shared\Reports;

use App\Models\Tenants\Company;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property string $id
 * @property string $company_id
 * @property string $report_id
 * @property-read Company $company
 * @property-read Report $report
 */
class ReportSubscription extends Pivot
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
    protected $table = 'company_report_subscriptions';

    protected $guarded = [
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }

}
