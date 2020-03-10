<?php

namespace App\Policies;

use App\Passenger;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PassengerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any passengers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->company_id === 0;
    }

    /**
     * Determine whether the user can view the passenger.
     *
     * @param  \App\User  $user
     * @param  \App\Passenger  $passenger
     * @return mixed
     */
    public function view(User $user, Passenger $passenger)
    {
        return ($user->company_id === $passenger->company_id || $user->company_id === 0);
    }

    /**
     * Determine whether the user can create passengers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the passenger.
     *
     * @param  \App\User  $user
     * @param  \App\Passenger  $passenger
     * @return mixed
     */
    public function update(User $user, Passenger $passenger)
    {
        return ($user->company_id === $passenger->company_id || $user->company_id === 0);
    }

    /**
     * Determine whether the user can delete the passenger.
     *
     * @param  \App\User  $user
     * @param  \App\Passenger  $passenger
     * @return mixed
     */
    public function delete(User $user, Passenger $passenger)
    {
        //
    }

    /**
     * Determine whether the user can restore the passenger.
     *
     * @param  \App\User  $user
     * @param  \App\Passenger  $passenger
     * @return mixed
     */
    public function restore(User $user, Passenger $passenger)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the passenger.
     *
     * @param  \App\User  $user
     * @param  \App\Passenger  $passenger
     * @return mixed
     */
    public function forceDelete(User $user, Passenger $passenger)
    {
        return ($user->company_id === $passenger->company_id || $user->company_id === 0);
    }
}
