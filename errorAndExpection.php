<?php

function log_errorANT($errno, $errstr, $errfile, $errline)
{
    global $body;
    $params = array(
        "message" => $errstr,
        "method" => @$body["method"],
        "status" => $errno,
        "line"=>$errline,
        "file"=>$errfile,
    );
    die(json_encode($params));
}

function log_error($errno, $errstr, $errfile, $errline)
{
    echo "ENTRA LOG ERROR";
    die();
}

set_error_handler('log_error');
// set_exception_handler('log_exception');

    // throw new Exception('División por cero.');  //-> sí entra en el CATCH

try {
    // $file_var = fopen("myfile.txt", "r");       // PHP Warning -> continues execution y no entran en catch
    // $total = 400 / 0;                           // PHP Warning
    $total = $njevo;                            // PHP Notice
    // trigger_error("MSG TRIGGER");

    echo "\nCONTINUA LUEGO DE WARNING";
    // throw new Exception('División por cero.');  // PHP Fatal error -> sí entra en el CATCH

} catch (Exception $e) {
    //throw $th;
    echo "EXCEPCION ---";
}

echo "\nEND ---";



