<?php

namespace Modules\Transactions\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Transactions\Database\factories\PurchaseFactory;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchases';
    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return PurchaseFactory::new();
    }
}
