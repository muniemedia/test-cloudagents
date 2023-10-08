<?php

namespace services;

require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;

class ChatGPTService
{
    protected $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->guzzle = new Client();
    }

    public function sendMessage($messages)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ];

        $options = [
            'headers' => $headers,
            'json' => [
                'model' => 'gpt-3.5-turbo-16k',
                'max_tokens' => 256,
                'temperature' => 0,
                'messages' => $messages,
            ],
        ];

        $response = $this->guzzle->post('https://api.openai.com/v1/chat/completions', $options);

        $body = $response->getBody();

        return $body;
    }
}
