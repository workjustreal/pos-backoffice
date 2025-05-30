<?php

use App\Http\Controllers\API\MobileAuthController;
use App\Http\Controllers\API\ProvinceController;
use App\Http\Controllers\API\ShippingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(RequestController::class)->group(function () {
    Route::post('/order/list', 'getOrderList');
});