<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\FetchTemperature;

class RunFetchTemperature extends Command
{
    protected $signature = 'fetch:temperature {date?}';
    protected $description = 'Fetch and store temperature data immediately';

    public function handle()
    {
        $city = config('services.weather.city');
        $date = $this->argument('date') ?: now()->toDateString();

        FetchTemperature::dispatch($city, $date);
        $this->info('Temperature fetched and stored.');
    }
}
