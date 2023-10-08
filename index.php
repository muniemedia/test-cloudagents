<?php

require __DIR__.'/vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$chatGPT = new \classes\ChatGPT();
$response = $chatGPT->test($_GET['input']);

echo $response;