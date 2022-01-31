<?php

namespace Modules\Transactions\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Masters\Entities\AccountMaster;
use Modules\Transactions\Database\factories\PurchaseFactory;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchases';
    protected $fillable = ['account_id','invoice_number','invoice_date','shipped_to'];

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

    protected static function newFactory()
    {
        return PurchaseFactory::new();
    }

    /**
     * @return HasMany
     */
    public function purchaseItems(): HasMany
    {
        return $this->hasMany(PurchaseItem::class, 'purchase_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(AccountMaster::class, 'account_id', 'id');
    }


    /**
     * @param float $number
     * @return string
     */
    public static function getIndianCurrency(float $number): string
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        
        $words = array(0 => '', 1 => 'One', 2 => 'Two',
            3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
            7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
            13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
            16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
            19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
            40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
            70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');

        $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
        
        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paisa' : '';
        return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
    }
}
