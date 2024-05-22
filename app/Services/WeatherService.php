<?php

namespace App\Services;

use App\Repositories\TemperatureRepository;
use App\DTO\TemperatureData;

class WeatherService implements WeatherServiceInterface
{
    protected WeatherClient $weatherClient;
    protected TemperatureRepository $temperatureRepository;

    public function __construct(WeatherClient $weatherClient, TemperatureRepository $temperatureRepository)
    {
        $this->weatherClient = $weatherClient;
        $this->temperatureRepository = $temperatureRepository;
    }

    public function updateTemperature(string $city, string $date): TemperatureData
    {
        $weatherData = $this->weatherClient->fetchWeather($city);
        $temperature = round($weatherData['main']['temp'], 1);

        $temperatureData = new TemperatureData($date, $city, $temperature);

        $this->temperatureRepository->create([
            'date'        => $temperatureData->date,
            'city'        => $temperatureData->city,
            'temperature' => $temperatureData->temperature,
        ]);

        return $temperatureData;
    }
}
