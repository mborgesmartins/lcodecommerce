<?php

namespace CodeCommerce\Events;

use CodeCommerce\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CheckoutEvent extends Event
{
    use SerializesModels;

    private $order;
    private $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($order, $user)
    {
        //
        $this->order = $order;
        $this->user = $user;

    }

    public function getUser() {

        return $this->user;
    }

    public function getOrder() {

        return $this->order;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
