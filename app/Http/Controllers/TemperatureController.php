<?php

namespace App\Http\Controllers;

use App\Http\Requests\TemperatureRequest;
use App\Repositories\TemperatureRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Exceptions\DataNotFoundException;

class TemperatureController extends Controller
{
    protected TemperatureRepository $temperatureRepository;

    public function __construct(TemperatureRepository $temperatureRepository)
    {
        $this->temperatureRepository = $temperatureRepository;
    }

    public function getTemperatureHistory(TemperatureRequest $request)
    {
        $date = $request->input('day');
        $cacheKey = "temperature_history_{$date}";

        $city = config('services.weather.city');

        if (Cache::has($cacheKey)) {
            $temperatures = Cache::get($cacheKey);
            Log::info('Fetching data from cache', ['date' => $date, 'city' => $city]);
        } else {
            Log::info('Fetching data from database', ['date' => $date, 'city' => $city]);
            $temperatures = $this->temperatureRepository->findByDateAndCity($date, $city);
            Cache::put($cacheKey, $temperatures, now()->addHours(1));
        }

        if ($temperatures->isEmpty()) {
            Log::error('No data found for this date', ['date' => $date]);
            throw new DataNotFoundException();
        }

        Log::info('Data found', ['date' => $date, 'data' => $temperatures]);
        return response()->json(['data' => $temperatures], 200);
    }
}
