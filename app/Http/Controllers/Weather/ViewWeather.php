<?php

namespace App\Http\Controllers\Weather;

use GuzzleHttp\Client;
use Inertia\Inertia;
use Inertia\Response;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class ViewWeather
{
    use AsAction;

    public function handle(float $lat, float $lon): Response
    {
        $apiKey = config('services.weather.key');
        $client = new Client();
        $response = $client->get("https://api.openweathermap.org/data/2.5/onecall?lat=$lat&lon=$lon&units=metric&appid=$apiKey");

        return Inertia::render('Weather/Index', [
            'weather' => json_decode($response->getBody()->getContents(), true)
        ]);
    }

    public function asController(ActionRequest $request): Response
    {
        $lat = $request->input('lat') ?? -8.6432626;
        $lon = $request->input('lon') ?? 115.203737;

        return $this->handle($lat, $lon);
    }
}
