<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Jobs\SendOrderEmail;
use App\Mail\OrderConfirmed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class sendOrderNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderPlaced $event): void
    {
        // Mail::to($event->order->user->email)->send(new OrderConfirmed($event->order));
        SendOrderEmail::dispatch($event->order->user->email);
    }
}
