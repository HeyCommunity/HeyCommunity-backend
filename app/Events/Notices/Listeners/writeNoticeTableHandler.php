<?php

namespace App\Events\Notices\Listeners;

use App\Events\Notices\MakeNoticeEvent;
use App\Models\Notice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class writeNoticeTableHandler
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
        Notice::create([
            'type'      =>  $event->type,
            'user_id'   =>  $event->user->id,
            'sender_id' =>  $event->sender->id,

            'entity_class'  => get_class($event->entity),
            'entity_id'  => class_basename($event->entity->id),
        ]);
    }
}
