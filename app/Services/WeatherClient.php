<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class WeatherClient
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.openweathermap.org',
        ]);
    }

    public function fetchWeather(string $city): array
    {
        try {
            $response = $this->client->get('/data/2.5/weather', [
                'query' => [
                    'q'     => $city,
                    'appid' => config('services.weather.api_key'),
                    'units' => 'metric'
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new \Exception("Weather API request failed: " . $e->getMessage());
        }
    }
}
