<?php

require __DIR__.'/vendor/autoload.php';


$chatGPT = new \classes\ChatGPT();
$response = $chatGPT->test($_GET['input']);

return $response;