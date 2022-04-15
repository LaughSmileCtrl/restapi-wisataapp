<?php

use App\Http\Controllers\MainImageController;
use App\Http\Controllers\PlaceGalleryController;
use App\Http\Controllers\TourismPlaceController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function() {
    Route::apiResource('tourism-places', TourismPlaceController::class)
        ->only(['index','store','show','update','destroy']);

    Route::post('tourism-places/{id}/gallery', [PlaceGalleryController::class, 'store']);
    Route::delete('tourism-places/{id}/gallery/{placeGallery}', [PlaceGalleryController::class, 'destroy']);

    Route::post('tourism-places/{id}/main-image', [MainImageController::class, 'update']);
    Route::delete('tourism-places/{id}/main-image', [MainImageController::class, 'destroy']);
});
