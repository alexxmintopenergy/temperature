<?php

namespace App\Services;

use App\DTO\TemperatureData;

interface WeatherServiceInterface
{
    public function updateTemperature(string $city, string $date): TemperatureData;
}
