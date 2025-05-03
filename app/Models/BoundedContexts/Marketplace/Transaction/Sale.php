<?php declare(strict_types=1);

namespace App\Models\BoundedContexts\Marketplace\Transaction;

use App\Models\BoundedContexts\LCA\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class Sale extends Transaction
{
    protected $table = 'sales';

    public static function getSaleQuantitiesByMonth(User $user, Carbon $firstSaleDate, Carbon $lastSaleDate, ?Builder $query = null): array
    {
        if ($query === null) {
            $query = Sale::query();
        }

        return $query
            ->where('sales.company_id', $user->company_id)
            ->whereBetween('sales.date_of_transaction', [$firstSaleDate, $lastSaleDate])
            ->selectRaw('MONTH(sales.date_of_transaction) as month, SUM(sales.quantity) as total_quantity')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total_quantity', 'month')
            ->toArray();
    }

    public static function getTopProductsBySales(User $user, Carbon $firstSaleDate, Carbon $lastSaleDate, int $topAmount): array
    {
        $sale = Sale::query()
            ->where('sales.company_id', $user->company_id)
            ->whereBetween('sales.date_of_transaction', [$firstSaleDate, $lastSaleDate])
            ->selectRaw('sales.product_id, SUM(sales.quantity) as total_quantity')
            ->groupBy('sales.product_id')
            ->orderByDesc('total_quantity')
            ->limit($topAmount)
            ->pluck('total_quantity', 'product_id')
            ->toArray();

        return self::getTopProductSkusFromIds($user, $sale);
    }

    public static function getSaleJointData(User $user, Carbon $firstSaleDate, Carbon $lastSaleDate, bool $isDomiciliary, string|null $filteredBrandId): Collection
    {
        return Sale::with(['product.recipes.material'])
            ->whereHas('product.recipes', function ($query) use ($user, $filteredBrandId, $isDomiciliary) {
                $query->where('company_id', $user->company_id)
                    ->when($filteredBrandId !== null, function ($query) use ($filteredBrandId) {
                        $query->where('brand_id', $filteredBrandId);
                    })
                    ->where('is_domiciliary', $isDomiciliary);
            })
            ->whereHas('product', function ($query) use ($user, $filteredBrandId) {
                $query->where('company_id', $user->company_id)
                    ->when($filteredBrandId !== null, function ($query) use ($filteredBrandId) {
                        $query->where('brand_id', $filteredBrandId);
                    });
            })
            ->whereBetween('sales.date_of_transaction', [$firstSaleDate, $lastSaleDate])
            ->get();
    }

    private static function getTopProductSkusFromIds(User $user, array $sales): array
    {
        $productIds = array_keys($sales);

        $productSkus = Product::query()
            ->whereIn('id', $productIds)
            ->where('company_id', '=', $user->company_id)
            ->pluck('sku', 'id')
            ->toArray();

        $salesWithSku = [];
        foreach ($productIds as $productId) {
            $salesWithSku[$productSkus[$productId]] = $sales[$productId];
        }

        return $salesWithSku;
    }
}
