<?php

namespace App\Listeners;

use App\Events\TaxiRequestConfirmed;
use App\Services\KcellSms;
use App\TaxiRequest;
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
        $text = $event->taxiRequest->sms_text($event->taxiRequest->company->confirm_sms_template);
        $phone = $event->taxiRequest->client->phone;

        $smsSender = new KcellSms();
        $smsSender->send($text, $phone);
    }
}
