<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiTestController extends Controller
{
    public function mockAirline($id, Request $request)
    {
        // Read query parameters with default values
        $delayMs = (int) $request->query('delay', 800); // default 800ms
        $flightCount = (int) $request->query('flights', 25); // default 25 flights
        $notesRepeat = (int) $request->query('notes', 40); // default 40 repeats (~1KB)

        // Apply delay (convert ms to microseconds)
        usleep($delayMs * 1000);

        // Build mock flight data
        $flight = [
            'airline' => 'MockAir',
            'flight_no' => 'MA' . rand(100, 999),
            'departure' => 'LHE',
            'arrival' => 'DXB',
            'departure_time' => now()->addHours(rand(1, 12))->toDateTimeString(),
            'arrival_time' => now()->addHours(rand(13, 24))->toDateTimeString(),
            'duration' => rand(2, 7) . 'h ' . rand(0, 59) . 'm',
            'baggage' => '20kg',
            'fare_class' => 'Economy',
            'seats_available' => rand(1, 9),
            'price' => rand(100, 900),
            'currency' => 'USD',
            'aircraft' => 'Airbus A320',
            'stops' => 0,
            'refundable' => true,
            'notes' => str_repeat('This is a sample note. ', $notesRepeat),
            'source_airline_id' => $id,
        ];

        $data = [
            'airline_id' => $id,
            'total_results' => $flightCount,
            'flights' => array_fill(0, $flightCount, $flight),
        ];

        return response()->json($data);
    }
}
