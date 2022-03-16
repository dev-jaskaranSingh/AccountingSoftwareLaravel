<?php

namespace Modules\Transactions\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Masters\Entities\AccountGroup;
use Modules\Masters\Entities\AccountMaster;
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

    /**
     * @return BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(AccountMaster::class, 'account_id');
    }

    /**
     * @return BelongsTo
     */
    public function account2(): BelongsTo
    {
        return $this->belongsTo(AccountGroup::class, 'account_id2');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
