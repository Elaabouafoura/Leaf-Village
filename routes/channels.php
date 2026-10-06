<?php

use Illuminate\Support\Facades\Broadcast;

// Channel public pour les tests
Broadcast::channel('notifications', function () {
    return true;
});