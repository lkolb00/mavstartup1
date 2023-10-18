<?php

use App\Http\Controllers\Api\AffiliationController;
use App\Http\Controllers\Api\SchoolController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SchoolSummaryController;

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

Route::get('/version', function () {
    $object = new \App\Http\Resources\MavResource(null);

    return response()->json(array_merge([
        'data' => 'Welcome to the Mav Api',
        'mav_config' => config('mav'),
    ], $object::$meta), 200);
})->name('version');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('SchoolSummary', [SchoolSummaryController::class, 'getSchoolSummary']);




Route::apiResources([
    'affiliations' => AffiliationController::class,
    'schools' => SchoolController::class,
]);
