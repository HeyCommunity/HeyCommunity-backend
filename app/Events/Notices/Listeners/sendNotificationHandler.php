<?php

namespace App\Events\Notices\Listeners;

use App\Events\Notices\MakeNoticeEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class sendNotificationHandler
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
     * @param  MakeNoticeEvent  $event
     * @return void
     */
    public function handle(MakeNoticeEvent $event)
    {
        //
    }
}
