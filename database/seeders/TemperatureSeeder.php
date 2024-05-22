<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Temperature;

class TemperatureSeeder extends Seeder
{
    public function run()
    {
        Temperature::create([
            'date' => now()->toDateString(),
            'city' => 'Kyiv',
            'temperature' => 15.5,
        ]);
    }
}
