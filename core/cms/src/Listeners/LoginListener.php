<?php
namespace Cms\Listeners;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Carbon;

class LoginListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event)
    {
        if ($event->guard == 'web') {
            $event->user->update([
                'last_login' => Carbon::now()
            ]);
        }
    }
}