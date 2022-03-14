<?php

namespace Modules\Transactions\Entities;

use App\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Masters\Entities\AccountMaster;
use Modules\Transactions\Database\factories\SaleFactory;

class SaleReturn extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'sale_return';

    protected static function newFactory()
    {
        return SaleReturnFactory::new();
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    /**
     * @return int
     */
    public static function getMaxInvoices(): int
    {
        if (is_null(self::max('invoice_number'))) {
            return 0;
        }
        return self::max('invoice_number');
    }

    /**
     * @return HasMany
     */
    public function saleReturnItems(): HasMany
    {
        return $this->hasMany(SaleReturnItem::class, 'sale_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function ledgerEntries(): HasMany
    {
        return $this->hasMany(FinanceLedger::class, 'bill_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(AccountMaster::class, 'account_id', 'id');
    }
}
