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
    return AccountMaster::whereNotNull('created_at')->pluck('name', 'id')->prepend('Select Account', null);
}

function getInstrTypeList(): array
{
    return [
        'chq no' => 'chq no',
        'RTGS' => 'RTGS',
        'CARD' => 'CARD',
        'MTRF' => 'MTRF',
        'NEFT' => 'NEFT',
        'DD' => 'DD',
        'TRF' => 'TRF',
        'CASH' => 'CASH',
    ];
}
