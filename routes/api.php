<?php
use OGame\Http\Controllers\PlayerController;
use Illuminate\Http\Request;

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
// routes/api.php
Route::get('/academy/status', [AcademyController::class, 'apiStatus']);
Route::get('/overview', [OverviewController::class, 'index'])->name('overview');
Route::get('/galaxy', [GalaxyController::class, 'index']);
Route::get('/academy/status', [AcademyController::class, 'status']);
Route::get('/players', [PlayerController::class, 'index']);
Route::get('/players/{id}', [PlayerController::class, 'show']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
