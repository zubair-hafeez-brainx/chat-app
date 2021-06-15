<?php

namespace App\Listeners;

use App\Events\MessageCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MessageCreatedListner
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
     * @param MessageCreated $event
     * @return array
     */
    public function handle(MessageCreated $event)
    {
        return ['message' => $event->data];
    }
}
