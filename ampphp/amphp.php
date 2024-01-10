<?php // hello-world.php

require __DIR__ . '/vendor/autoload.php';

use Amp\Future;
use function Amp\async;
use function Amp\delay;

$future1 = async(function () {
    // echo '1 INI \n';
    delay(0.3);
    // echo '1 FIN \n';
});

$future2 = async(function () {
    // echo '2 INI \n';
    delay(0.3);
    // echo '2 FIN \n';
});

// Our functions have been queued, but won't be executed until the event-loop gains control.

// Awaiting a future outside a fiber switches to the event loop until the future is complete.
// Once the event loop gains control, it executes our already queued functions we've passed to async()


echo "- INICIO\n";
$time_start = microtime(true); 
$future1->await();
$future2->await();
$time_end = microtime(true); 

$execution_time = ($time_end - $time_start);
echo $execution_time;

echo "- FIN\n";
