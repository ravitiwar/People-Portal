<?php


use App\Utils\AppUtils;
use Illuminate\Support\Facades\Route;

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
Route::post('/login', 'Api\LoginController@login');
Route::post('/refresh-token', 'Api\LoginController@refreshToken');
Route::get('/capabilities', function () {
    return response()->success(AppUtils::getCapabilies());
});
Route::middleware('auth:api')->group(function () {
    foreach (AppUtils::getMapingForendpoints() as $mapingForendpoint) {
        Route::{$mapingForendpoint['method']}($mapingForendpoint['endpoint'], $mapingForendpoint['controller_path'])
            ->middleware("can:{$mapingForendpoint['capability']}");
    }
});

