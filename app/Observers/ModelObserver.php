<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

class ModelObserver
{
    /**
     * Handle the Model "creating" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function creating(Model $model)
    {
        if(!$model->company_id || auth()->user()->company_id !== 0) {
            $model->company_id = auth()->user()->company_id;
        }
    }

    /**
     * Handle the Model "updating" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function updating(Model $model)
    {
        if(!$model->company_id || auth()->user()->company_id !== 0) {
            $model->company_id = auth()->user()->company_id;
        }
    }
}
