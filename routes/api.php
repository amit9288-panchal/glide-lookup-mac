<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\MacLookupController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Version v1 API routes
Route::prefix('v1')->middleware('auth.apikey')->group(function () {
    Route::get('/mac-lookup/{mac}', [MacLookupController::class, 'lookup']);
    Route::post('/mac-lookup/list', [MacLookupController::class, 'lookupList']);
});

