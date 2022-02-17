<?php

namespace Modules\Transactions\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
}
