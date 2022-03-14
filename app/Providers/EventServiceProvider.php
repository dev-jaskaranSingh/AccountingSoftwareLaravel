<?php

namespace App\Providers;

use App\Observers\HsnMasterObserver;
use App\Observers\ItemGroupMasterObserver;
use App\Observers\ItemMasterObserver;
use App\Observers\PurchaseReturnObserver;
use App\Observers\SaleReturnObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Masters\Entities\HsnMaster;
use Modules\Masters\Entities\ItemGroupMaster;
use Modules\Masters\Entities\ItemMaster;
use Modules\Transactions\Entities\Purchase;
use Modules\Transactions\Entities\PurchaseReturn;
use Modules\Transactions\Entities\Sale;
use Modules\Transactions\Entities\SaleReturn;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Sale::observe(SaleReturnObserver::class);
        Purchase::observe(PurchaseReturnObserver::class);
        ItemMaster::observe(ItemMasterObserver::class);
        ItemGroupMaster::observe(ItemGroupMasterObserver::class);
        HsnMaster::observe(HsnMasterObserver::class);
        SaleReturn::observe(SaleReturnObserver::class);
        PurchaseReturn::observe(PurchaseReturnObserver::class);
    }
}
