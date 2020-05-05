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

class TaxiRequestAssigned
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $taxiRequest;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(TaxiRequest $taxiRequest)
    {
        $this->taxiRequest = $taxiRequest;
    }
}
