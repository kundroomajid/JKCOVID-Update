<?php

use App\Http\Controllers\RegionsController;
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

Route::prefix('stats')->group(function () {
    Route::get('/all/{region?}', [RegionsController::class, 'statsAll']);
    Route::get('/latest/{region?}', [RegionsController::class, 'statsLatest']);
    Route::get('/yesterday/{region?}', [RegionsController::class, 'statsYesterday']);
    Route::get('/date/{date}/{region?}', [RegionsController::class, 'statsForDate']);
    Route::get('/currweek/{region?}', [RegionsController::class, 'statsCurrWeek']);
    Route::get('/prevweek/{region?}', [RegionsController::class, 'statsPrevWeek']);
    Route::get('/currmonth/{region?}', [RegionsController::class, 'statsCurrMonth']);
    Route::get('/prevmonth/{region?}', [RegionsController::class, 'statsPrevMonth']);
    Route::get('/month/{month}/{region?}', [RegionsController::class, 'statsForMonth']);

    Route::get('/daily/{region?}', [RegionsController::class, 'statsDaily']);
    Route::get('/weekly/{region?}', [RegionsController::class, 'statsWeekly']);
    Route::get('/monthly/{region?}', [RegionsController::class, 'statsMonthly']);

    Route::get('/detailed/{date?}', [RegionsController::class, 'detailedStats']);

    Route::get('/updatemissing', [RegionsController::class, 'updateMissingValues']);
});
