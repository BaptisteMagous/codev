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

Route::middleware('auth:sanctum')->get   ('{type}',                 [BatimentController::class, "index"]);
Route::middleware('auth:sanctum')->get   ('{type}/dept/{departement}',      [BatimentController::class, "dept"]);
Route::middleware('auth:sanctum')->get   ('{type}/commune/{commune}',       [BatimentController::class, "commune"]);
Route::middleware('auth:sanctum')->get   ('{type}/{longitude}/{latitude}',      [BatimentController::class, "zone"])
    ->where(['longitude' => '[0-9]+\.[0-9]+\:[0-9]+\.[0-9]+', 'latitude' => '[0-9]+\.[0-9]+\:[0-9]+\.[0-9]+']);

Route::middleware('auth:sanctum')->get   ('{type}/{batiment_id}',      [BatimentController::class, "show"]);


Route::middleware('auth:sanctum')->post   ('whoami',    function(Request $request){

    if (isset($request['user_token'])) {
        [$id, $user_token] = explode('|', $request['user_token'], 2);
        $token_data = DB::table('personal_access_tokens')->where('token', hash('sha256', $user_token))->first();

        $user = \App\Models\User::find($token_data->tokenable_id);
        return response()->json($user, 200);
    }

    return response()->json("No token given", 200);
});

// Route::post  ('batiments',                 [BatimentController::class, "store"]);

// Route::put   ('batiments/{batiment}',      [BatimentController::class, "update"]);

// Route::delete('batiments/{batiment}',      [BatimentController::class, "delete"]);
