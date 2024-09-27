<?php 

use App\Http\Controllers\LedgerController;
use App\Http\Controllers\LoginUSerController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\ExpectedIncomesController;
use App\Http\Controllers\AllocationController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function(){
    Route::get('/welcome', [WebsiteController::class, 'welcome']);
    Route::post('/register', [RegisterUserController::class, 'store']);
    Route::post('/login', [LoginUSerController::class, 'store']);
    Route::post('/forgot', [LoginUSerController::class, 'forgot']);
    Route::post('/forgot/createPass', [LoginUSerController::class, 'createPass']);
});

Route::middleware('auth:api')->group(function(){
    Route::get('/home', [WebsiteController::class, 'home']);
    Route::get('/dashboard', [WebsiteController::class, 'dashboard']);

    // Tracking
    Route::get('/trackings', [WebsiteController::class, 'tracking']);
    Route::get('/trackings/expenses', [WebsiteController::class, 'tracking_expenses']);
    Route::get('/trackings/incomes', [WebsiteController::class, 'tracking_incomes']);
    Route::post('/trackings', [TrackingController::class, 'store']);
    Route::delete('/trackings/{tracking}', [TrackingController::class, 'delete']);

    // Ledger
    Route::get('/ledger', [WebsiteController::class, 'ledger']);
    Route::get('/ledger/pay', [WebsiteController::class, 'ledger_toPay']);
    Route::get('/ledger/buy', [WebsiteController::class, 'ledger_toBuy']);
    Route::post('/ledgers', [LedgerController::class, 'store']);
    Route::put('/ledgers/{ledger}', [LedgerController::class, 'update']);
    Route::put('/ledgers/checked/{check}', [LedgerController::class, 'check']);
    Route::delete('/ledgers/{ledger}', [LedgerController::class, 'destroy']);
    Route::delete('/ledgers/delete-selected', [LedgerController::class, 'destroy_selected']);

    // Planner
    Route::get('/planner', [WebsiteController::class, 'planner']);
    Route::post('/planner', [ExpectedIncomesController::class, 'store']);
    Route::delete('/planner/reset/{id}', [WebsiteController::class, 'reset_planner']);
    Route::post('/planner/allocate', [AllocationController::class, 'allocate']);

    // Account
    Route::get('/account/profile', [WebsiteController::class, 'profile']);
    Route::put('/account/password/{id}', [LoginUSerController::class, 'changePass']);
    Route::put('/account/profile/{id}', [LoginUSerController::class, 'updateInfo']);
    Route::put('/account/profile/pic/{id}', [LoginUSerController::class, 'updatePic']);
    Route::post('/account/logout', [LoginUSerController::class, 'logout']);
    Route::post('/account/password/reset', [LoginUSerController::class, 'resetPass']);
    Route::delete('/account/suicide', [LoginUSerController::class, 'suicide']);
});
