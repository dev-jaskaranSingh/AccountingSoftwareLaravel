<?php

namespace App\Providers;

use App\Observers\HsnMasterObserver;
use App\Observers\ItemGroupMasterObserver;
use App\Observers\ItemMasterObserver;
use App\Observers\PurchaseObserver;
use App\Observers\SaleObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Masters\Entities\HsnMaster;
use Modules\Masters\Entities\ItemGroupMaster;
use Modules\Masters\Entities\ItemMaster;
use Modules\Transactions\Entities\Purchase;
use Modules\Transactions\Entities\Sale;

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
        Sale::observe(SaleObserver::class);
        Purchase::observe(PurchaseObserver::class);
        ItemMaster::observe(ItemMasterObserver::class);
        ItemGroupMaster::observe(ItemGroupMasterObserver::class);
        HsnMaster::observe(HsnMasterObserver::class);
    }
}
