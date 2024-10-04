<?php

use App\Http\Controllers\AdminCourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\LoginUSerController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\ExpectedIncomesController;
use App\Http\Controllers\AllocationController;

use App\Http\Controllers\AdminAssetController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminCategoryController;

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function(){
    Route::view('/', 'website.welcome');
    Route::view('/SmartBudget', 'website.welcome');
    Route::get('/SmartBudget/welcome', [WebsiteController::class, 'welcome'])->name('welcome');
    Route::get('SmartBudget/register', [RegisterUserController::class, 'register'])->name('register');
    Route::post('SmartBudget/register', [RegisterUserController::class, 'store'])->name('register.store');

    Route::get('SmartBudget/login', [LoginUSerController::class, 'login'])->name('login');
    Route::post('SmartBudget/login', [LoginUSerController::class, 'store'])->name('login.store');
    Route::get('SmartBudget/login/forgot', [LoginUSerController::class, 'forgot'])->name('forgot.page');

    // Route::post('SmartBudget/login/forgot', [LoginUSerController::class, 'forgor'])->name('forgot');
    // Route::get('SmartBudget/forgot/createPass', [LoginUSerController::class, 'createPass'])->name('createPass');
    // Route::put('SmartBudget/forgot/createPass', [LoginUSerController::class, 'storePass'])->name('storePass');
});

Route::middleware('auth')->group(function(){
    Route::get('SmartBudget/home', [WebsiteController::class, 'home'])->name('home');

    Route::get('SmartBudget/dashboard', [WebsiteController::class, 'dashboard'])->name('dashboard');
    Route::get('SmartBudget/dashboard/weekly', [DashboardController::class, 'dashboard_weekly'])->name('dashboard.weekly');
    Route::get('SmartBudget/dashboard/monthly', [DashboardController::class, 'dashboard_monthly'])->name('dashboard.monthly');
    Route::get('SmartBudget/dashboard/yearly', [DashboardController::class, 'dashboard_yearly'])->name('dashboard.yearly');


    Route::get('SmartBudget/trackings', [WebsiteController::class, 'tracking'])->name('tracking');
    Route::get('SmartBudget/trackings/expenses', [WebsiteController::class, 'tracking_expenses'])->name('tracking.expenses');
    Route::get('SmartBudget/trackings/incomes', [WebsiteController::class, 'tracking_incomes'])->name('tracking.incomes');
    Route::post('SmartBudget/trackings', [TrackingController::class, 'store'])->name('tracking.store');
    Route::put('SmartBudget/trackings', [TrackingController::class, 'update'])->name('tracking.update');
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
    Route::post('SmartBudget/planner/expected', [ExpectedIncomesController::class, 'store'])->name('planner.expected');
    Route::put('SmartBudget/planner/expected', [ExpectedIncomesController::class, 'update'])->name('planner.expected.update');
    Route::delete('SmartBudget/planner/expected', [ExpectedIncomesController::class, 'delete'])->name('planner.expected.delete');
    Route::delete('SmartBudget/planner/reset/{id}', [WebsiteController::class, 'reset_planner'])->name('planner.reset');
    Route::post('SmartBudget/planner/allocate', [AllocationController::class, 'allocate'])->name('planner.allocate');

    Route::get('SmartBudget/about', [WebsiteController::class, 'about'])->name('about');

    Route::get('SmartBudget/account/profile', [WebsiteController::class, 'profile'])->name('account.profile');
    Route::put('SmartBudget/account/password/{id}', [LoginUSerController::class, 'changePass'])->name('account.password.update');
    Route::put('SmartBudget/account/profile/{id}', [LoginUSerController::class, 'updateInfo'])->name('account.profile.update');
    Route::put('SmartBudget/account/profile/pic/{id}', [LoginUSerController::class, 'updatePic'])->name('account.pic.update');
    Route::post('SmartBudget/acount/logout', [LoginUSerController::class, 'logout'])->name('account.logout');
    Route::post('SmartBudget/account/password/reset', [LoginUSerController::class, 'resetPass'])->name('account.password.reset');
    Route::get('SmartBudget/account/suicide', [LoginUSerController::class, 'suicide'])->name('account.suicide');
});

Route::middleware('admin')->group(function() {
    Route::get('admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');

    Route::get('SmartBudget/admin', [AdminAssetController::class, 'index'])->name('admin.index');
    Route::post('SmartBudget/admin', [AdminAssetController::class, 'admin_logout'])->name('admin.logout');

    Route::get('SmartBudget/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::delete('SmartBudget/admin/users/{id}', [AdminUserController::class, 'delete'])->name('admin.users.delete');

    Route::get('SmartBudget/admin/categories', [AdminCategoryController::class, 'index'])->name('admin.category.index');
    Route::get('SmartBudget/admin/categories/create', [AdminCategoryController::class, 'create'])->name('admin.category.create');
    Route::get('SmartBudget/admin/categories/edit/id', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');

    Route::get('SmartBudget/admin/courses', [AdminCourseController::class, 'index'])->name('admin.courses.index');
    Route::get('SmartBudget/admin/courses/create', [AdminCourseController::class, 'create'])->name('admin.courses.create');
    Route::post('SmartBudget/admin/courses/create', [AdminCourseController::class, 'store'])->name('admin.courses.store');
    Route::get('SmartBudget/admin/courses/edit/{course}', [AdminCourseController::class, 'edit'])->name('admin.courses.edit');
    Route::put('SmartBudget/admin/courses/edit/{course}', [AdminCourseController::class, 'update'])->name('admin.courses.update');
    Route::delete('SmartBudget/admin/courses/delete/{course}', [AdminCourseController::class, 'delete'])->name('admin.courses.delete');
});