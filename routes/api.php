<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BatimentController;
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

Route::get   ('{type}',                 [BatimentController::class, "index"]);
Route::get   ('{type}/dept/{departement}',      [BatimentController::class, "dept"]);
Route::get   ('{type}/commune/{commune}',       [BatimentController::class, "commune"]);
Route::get   ('{type}/{longitude}/{latitude}',      [BatimentController::class, "zone"])
    ->where(['longitude' => '[0-9]+\.[0-9]+\:[0-9]+\.[0-9]+', 'latitude' => '[0-9]+\.[0-9]+\:[0-9]+\.[0-9]+']);

Route::get   ('{type}/{batiment}',      [BatimentController::class, "show"])
    ->whereUuid('batiment');

// Route::post  ('batiments',                 [BatimentController::class, "store"]);

// Route::put   ('batiments/{batiment}',      [BatimentController::class, "update"]);

// Route::delete('batiments/{batiment}',      [BatimentController::class, "delete"]);
