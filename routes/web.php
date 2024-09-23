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
    Route::view('/', 'website.welcome');
    Route::get('/SmartBudget/welcome', [WebsiteController::class, 'welcome'])->name('welcome');
    Route::get('SmartBudget/register', [RegisterUserController::class, 'register'])->name('register');
    Route::post('SmartBudget/register', [RegisterUserController::class, 'store'])->name('register.store');

    Route::get('SmartBudget/login', [LoginUSerController::class, 'login'])->name('login');
    Route::post('SmartBudget/login', [LoginUSerController::class, 'store'])->name('login.store');
    Route::get('SmartBudget/login/forgot', [LoginUSerController::class, 'forgot'])->name('forgot');
    Route::get('SmartBudget/forgot/createPass', [LoginUSerController::class, 'createPass'])->name('createPass');
});

Route::middleware('auth')->group(function(){
    Route::get('SmartBudget/home', [WebsiteController::class, 'home'])->name('home');
    Route::get('SmartBudget/dashboard', [WebsiteController::class, 'dashboard'])->name('dashboard');

    Route::get('SmartBudget/trackings', [WebsiteController::class, 'tracking'])->name('tracking');
    Route::get('SmartBudget/trackings/expenses', [WebsiteController::class, 'tracking_expenses'])->name('tracking.expenses');
    Route::get('SmartBudget/trackings/incomes', [WebsiteController::class, 'tracking_incomes'])->name('tracking.incomes');
    Route::post('SmartBudget/trackings', [TrackingController::class, 'store'])->name('tracking.store');
    Route::delete('SmartBudget/trackings/{tracking}', [TrackingController::class, 'delete'])->name('tracking.delete');

    
    Route::get('SmartBudget/ledger', [WebsiteController::class, 'ledger'])->name('ledger');
    Route::get('SmartBudget/ledger/pay', [WebsiteController::class, 'ledger_toPay'])->name('ledger.toPay');
    Route::get('SmartBudget/ledger/buy', [WebsiteController::class, 'ledger_toBuy'])->name('ledger.toBuy');

    Route::post('SmartBudget/ledgers', [LedgerController::class, 'store'])->name('ledger.store');
    Route::put('SmartBudget/ledgers/{ledger}', [LedgerController::class, 'update'])->name('ledger.update');
    Route::put('SmartBudget/ledgers/checked/{check}', [LedgerController::class, 'check'])->name('ledger.check');
    Route::delete('SmartBudget/ledgers/{ledger}', [LedgerController::class, 'destroy'])->name('ledger.delete');
    Route::get('SmartBudget/ledgers/delete-selected', [LedgerController::class, 'destroy_selected'])->name('ledger.destroy_selected');

    Route::get('SmartBudget/planner', [WebsiteController::class, 'planner'])->name('planner');
    Route::post('SmartBudget/planner', [ExpectedIncomesController::class, 'store'])->name('planner.expected');
    Route::get('SmartBudget/planner/reset', [WebsiteController::class, 'reset_planner'])->name('planner.reset');
    Route::post('SmartBudget/planner/allocate', [AllocationController::class, 'allocate'])->name('planner.allocate');

    Route::get('SmartBudget/about', [WebsiteController::class, 'about'])->name('about');

    Route::get('SmartBudget/account/profile', [WebsiteController::class, 'profile'])->name('account.profile');
    Route::post('SmartBudget/acount/logout', [LoginUSerController::class, 'logout'])->name('account.logout');
    Route::post('SmartBudget/account/password/reset', [LoginUSerController::class, 'resetPass'])->name('account.password.reset');
});