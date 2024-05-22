<?php

namespace App\Jobs;

use App\Services\WeatherService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class FetchTemperature implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $city;
    protected string $date;

    public function __construct(string $city, string $date)
    {
        $this->city = $city;
        $this->date = $date;
    }

    public function handle(WeatherService $weatherService): void
    {
        try {
            $temperatureData = $weatherService->updateTemperature($this->city, $this->date);
            Log::info('Temperature data fetched and stored successfully.', ['temperature' => $temperatureData]);
        } catch (\Exception $e) {
            Log::error('An error occurred while fetching temperature data', ['message' => $e->getMessage()]);
        }
    }
}
