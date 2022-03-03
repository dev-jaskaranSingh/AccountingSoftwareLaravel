<?php

namespace Modules\Transactions\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Transactions\Database\factories\FinanceLedgerFactory;

class FinanceLedger extends Model
{
    use HasFactory;

    protected $table = 'finance_ledger';
    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return FinanceLedgerFactory::new();
    }

    /**
     * @return BelongsTo
     */
    public function purchase(): BelongsTo
    {
        return $this->belongsTo(Purchase::class, 'bill_id');
    }
}
