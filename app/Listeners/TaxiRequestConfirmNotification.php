<?php

namespace App\Listeners;

use App\Events\TaxiRequestConfirmed;
use App\Services\KcellSms;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TaxiRequestConfirmNotification
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
     * @param  TaxiRequestConfirmed  $event
     * @return void
     */
    public function handle(TaxiRequestConfirmed $event)
    {
        $smsSender = new KcellSms();
        $smsSender->send('Your taxi request has been confirmed', $event->taxiRequest->client->phone);
    }
}
