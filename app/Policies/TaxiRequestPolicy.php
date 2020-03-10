<?php

namespace App\Policies;

use App\TaxiRequest;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaxiRequestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any taxi requests.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->company_id === 0;
    }

    /**
     * Determine whether the user can view the taxi request.
     *
     * @param  \App\User  $user
     * @param  \App\TaxiRequest  $taxiRequest
     * @return mixed
     */
    public function view(User $user, TaxiRequest $taxiRequest)
    {
        return ($user->company_id === $taxiRequest->company_id || $user->company_id === 0);
    }

    /**
     * Determine whether the user can create taxi requests.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the taxi request.
     *
     * @param  \App\User  $user
     * @param  \App\TaxiRequest  $taxiRequest
     * @return mixed
     */
    public function update(User $user, TaxiRequest $taxiRequest)
    {
        return ($user->company_id === $taxiRequest->company_id || $user->company_id === 0);
    }

    /**
     * Determine whether the user can delete the taxi request.
     *
     * @param  \App\User  $user
     * @param  \App\TaxiRequest  $taxiRequest
     * @return mixed
     */
    public function delete(User $user, TaxiRequest $taxiRequest)
    {
        //
    }

    /**
     * Determine whether the user can restore the taxi request.
     *
     * @param  \App\User  $user
     * @param  \App\TaxiRequest  $taxiRequest
     * @return mixed
     */
    public function restore(User $user, TaxiRequest $taxiRequest)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the taxi request.
     *
     * @param  \App\User  $user
     * @param  \App\TaxiRequest  $taxiRequest
     * @return mixed
     */
    public function forceDelete(User $user, TaxiRequest $taxiRequest)
    {
        return ($user->company_id === $taxiRequest->company_id || $user->company_id === 0);
    }
}
