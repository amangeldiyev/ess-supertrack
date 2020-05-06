<?php

namespace App\Listeners;

use App\Events\TaxiRequestAssigned;
use App\Services\KcellSms;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TaxiRequestAssignedNotification
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
     * @param  TaxiRequestAssigned  $event
     * @return void
     */
    public function handle(TaxiRequestAssigned $event)
    {
        $text = $event->taxiRequest->sms_text($event->taxiRequest->company->assign_sms_template);
        $phone = $event->taxiRequest->client->phone;

        $smsSender = new KcellSms();
        $smsSender->log($text, $phone);
    }
}
