<?php

namespace App\Listeners;

use App\Events\TaxiRequestConfirmed;
use App\Mail\TaxiRequestConfirmed as MailTaxiRequestConfirmed;
use App\Services\KcellSms;
use App\TaxiRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

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
        $client = $event->taxiRequest->client;

        if ($event->sms_notification) {
            $smsSender = new KcellSms();
            $smsSender->log($text, $client->phone);
        }

        if ($event->email_notification) {
            Mail::to($client->email)->send(new MailTaxiRequestConfirmed($text));
        }
    }
}
