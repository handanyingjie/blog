<?php

namespace App\Events\Post;

use App\Models\Post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Update
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $new;
    public $old;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($new, $old)
    {
        $this->new = $new;
        $this->old = $old;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
