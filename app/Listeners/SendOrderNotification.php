<?php

namespace App\Listeners;

use App\Events\OrderPlaced;

final class SendOrderNotification
{
    public function handle(OrderPlaced $event): void
    {
        // TODO: Send email to user
    }
}
