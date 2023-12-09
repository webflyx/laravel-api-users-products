<?php

namespace App\Listeners;

use App\Events\NewProductProccessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogNewProduct
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
    public function handle(NewProductProccessed $event): void
    {
        Log::debug('NEW PRODUCT '.$event->product->title);
    }
}
