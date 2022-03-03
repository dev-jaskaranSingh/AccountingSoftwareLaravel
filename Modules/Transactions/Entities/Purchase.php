<?php

namespace Modules\Transactions\Entities;

use App\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Masters\Entities\AccountMaster;

/**
 * @method static create(array $validated)
 */
class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchases';
    protected $guarded = ['id'];

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
     * @return HasMany
     */
    public function purchaseItems(): HasMany
    {
        return $this->hasMany(PurchaseItem::class, 'purchase_id', 'id');
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

    /**
     * @param $value
     * @return void
     */
    public function setTotalAmountAttribute($value)
    {
        $this->attributes['total_amount'] = floatval($value);
    }

    /**
     * @param $value
     * @return void
     */
    public function setTotalDiscountAttribute($value)
    {
        $this->attributes['total_discount'] = floatval($value);
    }

    /**
     * @param $value
     * @return void
     */
    public function setTotalNetAmountAttribute($value)
    {
        $this->attributes['total_net_amount'] = floatval($value);
    }

    /**
     * @param $value
     * @return void
     */
    public function setCgstAttribute($value)
    {
        $this->attributes['cgst'] = floatval($value);
    }

    /**
     * @param $value
     * @return void
     */
    public function setSgstAttribute($value)
    {
        $this->attributes['sgst'] = floatval($value);
    }

    /**
     * @param $value
     * @return void
     */
    public function setIgstAttribute($value)
    {
        $this->attributes['igst'] = floatval($value);
    }

    /**
     * @param $value
     * @return void
     */
    public function setGrandTotalAmountAttribute($value)
    {
        $this->attributes['grand_total_amount'] = floatval($value);
    }
}
