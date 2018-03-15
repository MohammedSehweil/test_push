<?php

namespace App\Listeners;

use App\Events\Currency;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CurrencyNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Currency  $event
     * @return void
     */
    public function handle(Currency $event)
    {
        dd($event->data);
        $currency = $event->currency;
        $currency->update(['exchange_rate' => 500]);
    }
}
