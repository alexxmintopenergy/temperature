<?php

namespace App\DTO;

class TemperatureData
{
    public string $date;
    public string $city;
    public float $temperature;

    public function __construct(string $date, string $city, float $temperature)
    {
        $this->date = $date;
        $this->city = $city;
        $this->temperature = $temperature;
    }
}
