<?php

use Modules\Masters\Entities\AccountMaster;

/**
 * @return mixed
 */


function getFirstAccountsList(): mixed
{
    $CASH_IN_HAND = 4;
    $BANK_ACCOUNTS = 1;
    return AccountMaster::whereIn('account_group_id', [$CASH_IN_HAND, $BANK_ACCOUNTS])->pluck('name', 'id')->prepend('Select Account', null);
}

/**
 * @return mixed
 */
function getSecondAccountsList(): mixed
{
    $CASH_IN_HAND = 4;
    $BANK_ACCOUNTS = 1;
    return AccountMaster::whereNotIn('account_group_id', [$CASH_IN_HAND, $BANK_ACCOUNTS])->pluck('name', 'id')->prepend('Select Account', null);
}

function getInstrTypeList(): array
{
    return [
        'Chq No' => 'Chq No',
        'CARD' => 'CARD',
        'CASH' => 'CASH',
        'DD' => 'DD',
        'MTRF' => 'MTRF',
        'NEFT' => 'NEFT',
        'RTGS' => 'RTGS',
        'TRF' => 'TRF',
    ];
}
