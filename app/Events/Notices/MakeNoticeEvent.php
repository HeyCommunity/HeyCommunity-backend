<?php

namespace App\Events\Notices;

use App\Models\Common\Thumb;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MakeNoticeEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $type;
    public $user;
    public $sender;
    public $entity;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($type, User $user, User $sender, $entity)
    {
        $this->type = $type;
        $this->user = $user;
        $this->sender = $sender;
        $this->entity = $entity;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
