<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;

use App\Http\Controllers\IndividualController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function(){
    Route::apiResource('individual', IndividualController::class);
});

/*Route::fallback(function () {
    return response()->json([
        'message' => 'Esta página não existe.',
        'status' => Response::HTTP_NOT_FOUND
    ], Response::HTTP_NOT_FOUND);
});*/
