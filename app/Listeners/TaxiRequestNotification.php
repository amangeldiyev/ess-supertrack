<?php

namespace App\Listeners;

use App\Mail\TaxiRequestConfirmed;
use App\Services\KcellSms;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

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
        $client = $event->taxiRequest->client;

        if ($event->sms_notification && !empty($event->text)) {
            $smsSender = new KcellSms();
            $smsSender->log($event->text, $client->phone);
        }

        if ($event->email_notification && !empty($event->text)) {
            Mail::to($client->email)->send(new TaxiRequestConfirmed($event->text));
        }
    }
}
