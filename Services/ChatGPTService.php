<?php

namespace Services;

require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;

class ChatGPTService
{
    protected $apiKey;
    /**
     * @var Client
     */
    private $guzzle;

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

        $body = $response->getBody()->getContents();

        return $body;
    }

    public function sendMessageCurl($messages)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.openai.com/v1/chat/completions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
            "model": "gpt-3.5-turbo-16k",
            "messages": [{"role": "user", "content": "Hello, how are you today?"}],
            "max_tokens": 128,
            "temperature": 0
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer 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'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
}
