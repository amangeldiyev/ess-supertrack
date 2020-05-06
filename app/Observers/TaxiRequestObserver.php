<?php

namespace App\Observers;

use App\Events\TaxiRequestAssigned;
use App\Events\TaxiRequestConfirmed;
use App\TaxiRequest;

class TaxiRequestObserver
{
    /**
     * Handle the taxi request "created" event.
     *
     * @param  \App\TaxiRequest  $taxiRequest
     * @return void
     */
    public function created(TaxiRequest $taxiRequest)
    {
        //
    }

    /**
     * Handle the taxi request "updated" event.
     *
     * @param  \App\TaxiRequest  $taxiRequest
     * @return void
     */
    public function updated(TaxiRequest $taxiRequest)
    {
        //
    }

    /**
     * Handle the taxi request "saving" event.
     *
     * @param  \App\TaxiRequest  $taxiRequest
     * @return void
     */
    public function saving(TaxiRequest $taxiRequest)
    {
        if ($taxiRequest->status == 2 && $taxiRequest->notification_sent < 2) {
            event(new TaxiRequestAssigned($taxiRequest));

            $taxiRequest->notification_sent = 2;
        }
    }

    /**
     * Handle the taxi request "deleted" event.
     *
     * @param  \App\TaxiRequest  $taxiRequest
     * @return void
     */
    public function deleted(TaxiRequest $taxiRequest)
    {
        //
    }

    /**
     * Handle the taxi request "restored" event.
     *
     * @param  \App\TaxiRequest  $taxiRequest
     * @return void
     */
    public function restored(TaxiRequest $taxiRequest)
    {
        //
    }

    /**
     * Handle the taxi request "force deleted" event.
     *
     * @param  \App\TaxiRequest  $taxiRequest
     * @return void
     */
    public function forceDeleted(TaxiRequest $taxiRequest)
    {
        //
    }
}
