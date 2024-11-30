<?php
namespace App\Services;

use GuzzleHttp\Client;

class OpenAIService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://api.openai.com/v1/']);
    }

    public function chat($prompt)
    {
        $response = $this->client->post('chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-4',
                'messages' => [
                    ['role' => 'system', 'content' => 'Você é um assistente agrícola inteligente.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
