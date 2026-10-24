<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use TradeInTradeUp\Http\Controllers\CustomerInfoSectionsController;
use TradeInTradeUp\Http\Controllers\ReceiptSectionsController;
use TradeInTradeUp\Http\Controllers\SubmissionsController;
use TradeInTradeUp\Http\Controllers\TradedinSectionsController;
use TradeInTradeUp\Http\Controllers\TradedupSectionsController;
use TradeInTradeUp\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/upploadr', [SubmissionsController::class, 'uploadfiles']);
Route::post('/upploadr/remove', [SubmissionsController::class, 'fileremove']);

Route::get('/receive-products', [SubmissionsController::class, 'getProducts']);

Route::middleware('auth:api')->get('/check-redeem', [SubmissionsController::class, 'checkRedeem']);

Route::middleware('auth:api')->get('/get-rebate/{id}', [SubmissionsController::class, 'getSubmissionApi']);
Route::get('/verify-email', [UserController::class, 'existingUser']);
Route::get('/get-my-info', [UserController::class, 'existingUsersInfo']);
Route::get('/get-brands', [SubmissionsController::class, 'getBrands']);

Route::middleware('auth:api')->get('/my-info', [UserController::class, 'getInfo']);
Route::middleware('auth:api')->get('/get-my-rebates/{currency}', [SubmissionsController::class, 'getCustomersRebate']);
Route::middleware('auth:api')->get('/get-my-certificates/{currency}', [SubmissionsController::class, 'getCustomersCertificates']);
Route::middleware('auth:api')->post('/redeem', [SubmissionsController::class, 'redeemNow']);
Route::middleware('auth:api')->post('/upload-submission', [SubmissionsController::class, 'createSubmission']);
Route::middleware('auth:api')->post('/auth-removeoldfiles', [SubmissionsController::class, 'authremoveoldfiles']);
Route::middleware('auth:api')->post('/edit-billing', [CustomerInfoSectionsController::class, 'updateApi']);
Route::middleware('auth:api')->post('/edit-tradeins', [TradedinSectionsController::class, 'updateApi']);
Route::middleware('auth:api')->post('/edit-receipt', [ReceiptSectionsController::class, 'updateApi']);
Route::middleware('auth:api')->post('/edit-tradeups', [TradedupSectionsController::class, 'updateApi']);
Route::middleware('auth:api')->post('/update-profile', [UserController::class, 'updateProfileApi']);

Route::middleware('api')->post('/login-access', [UserController::class, 'loginApi']);

Route::middleware('api')->post('/testapi', [UserController::class, 'testapi']);

Route::middleware('auth:api')->post('/submit-rebate', [SubmissionsController::class, 'test']);
Route::post('/register-profile', [UserController::class, 'registerApi']);
