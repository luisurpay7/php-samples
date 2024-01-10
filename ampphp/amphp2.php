<?php

require __DIR__ . '/vendor/autoload.php';

use Amp\Future;
use function Amp\async;
use function Amp\delay;

$future1 = Amp\async(static function () {
    for ($i = 0; $i < 5; $i++) {
        echo '.';
        Amp\delay(1);
    }
    return "retornoFuture1";
});

$future2 = Amp\async(static function () {
    for ($i = 0; $i < 5; $i++) {
        echo '_';
        Amp\delay(0.5);
    }
    return "retornoFuture2";
});

function msgFinal() {
    echo "FINAL";
}

$data1 = $future1->await();
$data2 = $future2->await();
// msgFinal();

echo $data2;
echo $data1;
