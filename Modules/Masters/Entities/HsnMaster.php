<?php

namespace Modules\Masters\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Masters\Database\factories\HsnMasterFactory;

class HsnMaster extends Model
{
    use HasFactory;
    protected $table = 'hsn_master';
    protected $fillable = ['hsn_code', 'hsn_description', 'min_amount', 'gst_min_percentage', 'gst_max_percentage'];

    protected static function newFactory()
    {
        return HsnMasterFactory::new();
    }
}
