<?php

namespace App\Observers;
class LogObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function created($table)
    {
        //die(\Auth::user()->name);
        dd($objeto);
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
    public function deleted($table)
    {
        //
    }
}