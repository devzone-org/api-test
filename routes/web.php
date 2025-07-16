<?php
use App\Http\Controllers\ApiTestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});




Route::get('/mock-airline/{id}', [ApiTestController::class, 'mockAirline']);
