<?php

function onDie(){
    $message = ob_get_contents(); // Capture 'Doh'
    ob_end_clean(); // Cleans output buffer
    echo $message;
    echo "test";
}
register_shutdown_function('onDie');
//...
ob_start(); // You need this to turn on output buffering before using die/exit
@$dumbVar = 1000/0 or die('Doh'); // "@" prevent warning/error from php
//...
ob_end_clean(); // Remember clean your buffer before you need to use echo/print