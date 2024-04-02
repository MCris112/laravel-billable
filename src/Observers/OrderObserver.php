<?php

namespace MCris112\Billable\Observers;

use Illuminate\Support\Facades\Cache;
use MCris112\Billable\Models\Order;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        $this->updateCached($order);
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        $this->updateCached($order);
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        $this->updateCached($order);
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        $this->updateCached($order);
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        $this->updateCached($order);
    }

    private function updateCached(Order $order)
    {
        Cache::forget('order_'.$order->id);
    }

}
