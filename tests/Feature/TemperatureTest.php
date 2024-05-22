<?php

namespace Tests\Feature;

use App\Jobs\FetchTemperature;
use App\Models\Temperature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class TemperatureTest extends TestCase
{
    use RefreshDatabase;

    public function testTemperatureIsStoredCorrectly()
    {
        Http::fake([
            'api.openweathermap.org/*' => Http::response(['main' => ['temp' => 15.5]], 200),
        ]);

        FetchTemperature::dispatchSync();

        $this->assertDatabaseHas('temperatures', [
            'city' => 'Kyiv',
            'temperature' => 15.5,
        ]);
    }

    public function testGetTemperatureHistoryWithValidDate()
    {
        Temperature::create([
            'date' => now()->toDateString(),
            'city' => 'Kyiv',
            'temperature' => 20.5,
        ]);

        $response = $this->withHeaders(['x-token' => config('services.weather.x_token')])
            ->get('/api/temperature-history?day=' . now()->toDateString());

        $response->assertStatus(200)
            ->assertJson(['data' => [['temperature' => 20.5]]]);
    }

    public function testGetTemperatureHistoryWithInvalidDate()
    {
        $response = $this->withHeaders(['x-token' => config('services.weather.x_token')])
            ->get('/api/temperature-history?day=invalid-date');

        $response->assertStatus(400)
            ->assertJson(['error' => 'Invalid date format']);
    }

    public function testUnauthorizedAccess()
    {
        $response = $this->get('/api/temperature-history?day=' . now()->toDateString());

        $response->assertStatus(401)
            ->assertJson(['error' => 'Unauthorized']);
    }
}
