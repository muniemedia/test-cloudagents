<?php

require __DIR__.'/vendor/autoload.php';

use Controllers\ChatGPT;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$chatGPT = new ChatGPT();
$response = $chatGPT->test($_GET['input']);

echo $response;