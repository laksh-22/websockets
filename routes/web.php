<?php

use App\Http\Controllers\SocketController;
use App\Services\ConnectionStorageService;
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