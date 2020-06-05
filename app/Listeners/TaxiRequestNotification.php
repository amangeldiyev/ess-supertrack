<?php

namespace App\Listeners;

use App\Contracts\SmsProvider;
use App\Mail\TaxiRequestConfirmed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class TaxiRequestNotification
{
    protected $smsProvider;

    /**
     * Create the event listener
     *
     * @param SmsProvider $smsProvider
     * @return void
     */
    public function __construct(SmsProvider $smsProvider)
    {
        $this->smsProvider = $smsProvider;
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
            $this->smsProvider->send($event->text, $client->phone);
        }

        if ($event->email_notification && !empty($event->text)) {
            Mail::to($client->email)->queue(new TaxiRequestConfirmed($event->text));
        }
    }
}
