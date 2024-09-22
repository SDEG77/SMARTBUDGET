<?php

use App\Http\Controllers\LoginUSerController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'website.welcome');

Route::middleware('guest')->group(function(){
Route::get('/SmartBudget/welcome', [WebsiteController::class, 'welcome'])->name('welcome');
Route::get('SmartBudget/register', [RegisterUserController::class, 'register'])->name('register');
Route::post('SmartBudget/register', [RegisterUserController::class, 'store'])->name('register.store');
Route::get('SmartBudget/congrats', [RegisterUserController::class, 'congrats'])->name('register.congrats');


    Route::get('SmartBudget/login', [LoginUSerController::class, 'login'])->name('login');
    Route::post('SmartBudget/login', [LoginUSerController::class, 'store'])->name('login.store');
    Route::get('SmartBudget/login/forgot', [LoginUSerController::class, 'forgot'])->name('forgot');
    Route::get('SmartBudget/forgot/createPass', [LoginUSerController::class, 'createPass'])->name('createPass');
});

Route::middleware('auth')->group(function(){
Route::get('SmartBudget/home', [WebsiteController::class, 'home'])->name('home');
Route::get('SmartBudget/account/profile', [WebsiteController::class, 'profile'])->name('account.profile');
Route::post('SmartBudget/acount/logout', [LoginUSerController::class, 'logout'])->name('account.logout');
Route::post('SmartBudget/account/password/reset', [LoginUSerController::class, 'resetPass'])->name('account.password.reset');


});


// routes/web.php

Route::get('/profile', function () {
    return view('website.account.profile');

});
Route::get('/dashboard', function () {
    return view('website.account.dashboard');
})->name('dashboard');

Route::get('/tracking', function () {
    return view('website.account.tracking');
})->name('tracking');


Route::get('/ledger', function () {
    return view('website.account.ledger');
})->name('ledger');

Route::get('/planner', function () {
    return view('website.account.planner');
})->name('planner');

Route::get('/about', function () {
    return view('website.account.about');
})->name('about');

Route::get('/example', function () {
    return view('website.account.example');
})->name('example');



// Continue for other routes...
