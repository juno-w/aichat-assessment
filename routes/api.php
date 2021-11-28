<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\VisionController;
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

/**
 * Check if customer is eligible to claim a reward.
 */
Route::get('/campaign/{campaign:uuid}', [CampaignController::class, 'check']);

/**
 * Redeem a voucher.
 */
Route::post('/campaign/{campaign:uuid}/redeem-voucher', [CampaignController::class, 'redeemVoucher']);
