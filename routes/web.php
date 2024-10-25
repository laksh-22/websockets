<?php

use Illuminate\Support\Facades\Route;
use App\Events\TestEvent;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    event(new TestEvent('hell'));
    return response()->json(['message' => 'success']);
});

Route::get('/local', function () {
    event(new \App\Events\LocalEvent('local'));
    return response()->json(['message' => 'success']);
});

Route::get('/dedicated', function () {
    event(new \App\Events\DedicatedEvent('dedicated'));
    return response()->json(['message' => 'success']);
});
