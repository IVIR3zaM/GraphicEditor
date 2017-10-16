<?php
require_once 'vendor/autoload.php';
use IVIR3aM\GraphicEditor\ConsoleApp;

$app = new ConsoleApp();

$arguments = [];
foreach ($argv as $k => $arg) {
    if ($k === 1) {
        $arg = explode(':', $arg);
        $arguments['task'] = $arg[0];
        $arguments['action'] = $arg[1];
    } elseif ($k >= 2) {
        $arguments['params'][] = $arg;
    }
}

try {
    $app->handle($arguments);
} catch (Exception $e) {
    echo $e->getMessage();
}