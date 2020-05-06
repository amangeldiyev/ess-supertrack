<?php

namespace App\Events;

use App\TaxiRequest;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaxiRequestStatusChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $taxiRequest, $text, $sms_notification, $email_notification;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(TaxiRequest $taxiRequest, $text, $sms_notification, $email_notification)
    {
        $this->taxiRequest = $taxiRequest;
        $this->text = $text;
        $this->sms_notification = $sms_notification;
        $this->email_notification = $email_notification;
    }
}
