<?php

require 'vendor/autoload.php';

error_reporting(E_ALL);

$debug = true; // todo: set depending on environment

$woops = new \Whoops\Run;
if ($debug) {
    $woops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $woops->pushHandler(function($e){
        echo 'Friendly error page';
    });
    $woops->pushHandler(function($e){
        // send email to dev with error
    });
}
$woops->register();

throw new Exception;