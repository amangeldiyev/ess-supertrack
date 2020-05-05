<?php

namespace App\Listeners;

use App\Services\KcellSms;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TaxiRequestNotification
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $smsSender = new KcellSms();
        $smsSender->send('Your taxi request has been assigned(' . $event->taxiRequest->start_date . ')', $event->taxiRequest->client->phone);
    }
}
