<?php declare(strict_types=1);

namespace App\Models\BoundedContexts\Shared\Reports;

use App\Models\BoundedContexts\CholitaModel;
use App\Models\BoundedContexts\Reports\GeneratedReport;
use App\Models\Tenants\Company;
use App\Models\User;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $name
 * @property string $jurisdiction
 * @property string $country
 * @property null|string $available_periods
 * @property DateTimeInterface $next_due_date
 * @property string $entity_to_declare
 * @property string $template_path
 * @property string $law_link
 * @property string $created_by
 * @property Carbon|DateTimeInterface|string $created_at
 * @property Carbon|DateTimeInterface|string $updated_at
 * @property-read User $createdBy
 */

class Report extends CholitaModel
{
    protected $table = 'reports';

    protected $casts = [
        'available_periods' => 'array',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'company_report_subscriptions', 'report_id', 'company_id')
            ->using(ReportSubscription::class);
    }

    public function companyReportSubscriptions(): HasMany
    {
        return $this->hasMany(ReportSubscription::class);
    }

    public function generatedReports(): HasMany
    {
        return $this->HasMany(GeneratedReport::class);
    }

}
