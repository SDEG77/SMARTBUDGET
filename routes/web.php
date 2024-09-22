<?php

use App\Http\Controllers\LoginUSerController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\WebsiteController;
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
    Route::get('SmartBudget/planner', [WebsiteController::class, 'planner'])->name('planner');
    Route::get('SmartBudget/about', [WebsiteController::class, 'about'])->name('about');

    Route::get('SmartBudget/account/profile', [WebsiteController::class, 'profile'])->name('account.profile');
    Route::post('SmartBudget/acount/logout', [LoginUSerController::class, 'logout'])->name('account.logout');
    Route::post('SmartBudget/account/password/reset', [LoginUSerController::class, 'resetPass'])->name('account.password.reset');
});