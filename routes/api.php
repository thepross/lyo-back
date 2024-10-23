<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\BilleteraController;
use App\Http\Controllers\Api\V1\SeguimientoController;
use App\Http\Controllers\Api\V1\TransaccionController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\UsuarioController;
use App\Models\Transaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/status', function () {
    return response()->json([
        'status' => 'OK',
        'server_time' => now()->toDateTimeString(),
    ]);
});

Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('usuarios', UsuarioController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('billeteras', BilleteraController::class);
    Route::apiResource('transacciones', TransaccionController::class);
    Route::apiResource('seguimientos', SeguimientoController::class);

    Route::get('usuarios-f/billeteras/{id}', [UsuarioController::class, 'getAllBilleteras'])->name('usuarios.billeteras');
    Route::post('/profile-image', [UsuarioController::class, 'updateProfileImage']);

    Route::get('transacciones-f/billetera/{id}', [TransaccionController::class, 'getTransacciones'])->name('transacciones-f.billetera');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
