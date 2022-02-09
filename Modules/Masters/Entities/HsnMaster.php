<?php

namespace Modules\Masters\Entities;

use App\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Masters\Database\factories\HsnMasterFactory;

class HsnMaster extends Model
{
    use HasFactory;
    protected $table = 'hsn_master';
    protected $fillable = ['hsn_code', 'hsn_description', 'min_amount', 'gst_min_percentage', 'gst_max_percentage'];

    /**
     * @return mixed
     */
    protected static function newFactory()
    {
        return HsnMasterFactory::new();
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
}
