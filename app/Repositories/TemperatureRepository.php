<?php

namespace App\Repositories;

use App\Models\Temperature;

class TemperatureRepository
{
    public function findByDateAndCity(string $date, string $city)
    {
        return Temperature::where('date', $date)->where('city', $city)->get();
    }

    public function create(array $data)
    {
        return Temperature::create($data);
    }
}
