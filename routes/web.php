<?php

use App\Http\Controllers\NatsController;
use App\Http\Controllers\SocketController;
use App\Services\ConnectionStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

Route::get('/api/v3/installer', function () {
    return response()->json('ok');
});

Route::post('/api/v3/newagent', function (Request $request) {
    Log::info('rmm', (array)$request);
    return response()->json(['pk' => 1, 'token' => 'testToken']);
});

Route::post('/api/v3/installer', function () {
    return response()->json('ok');
});


Route::get('/test', function () {
    event(new TestEvent('lakshyaaay'));
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

Route::get('/test-websocket-route', function () {
//    $socket = stream_socket_client('tcp://127.0.0.1:6003');
//    fwrite($socket, 'Hello from HTTP route!');
//    fclose($socket);
//    app(SocketController::class)->sendToAll('hi from the server again');
    return response()->json(['message' => 'success']);
});

//\BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter::webSocket('/receive/websockets', \App\Services\MyCustomWebSocketHandler::class);

/**
 * NATS Section
 */

Route::get('/nats/check', [NatsController::class, 'setupNats']);