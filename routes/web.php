<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\Admin\DashboardContorller;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\Admin\InvitationController;




Route::get('/', [Authcontroller::class, 'index'])->name('login'); 
Route::get('/login', [AuthController::class, 'index'])->name('login.auth');

Route::post('/login', [Authcontroller::class, 'login'])->name('login');
 Route::get('/s/{code}', [RedirectController::class, 'resolve'])->middleware('auth')->name('shorturls.resolve');

Route::post('/logout', [Authcontroller::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardContorller::class, 'index'])->name('dashboard');
    Route::get('/short-urls', [ShortUrlController::class, 'index']);
    Route::post('/short-urls', [ShortUrlController::class, 'store'])->name('shorturls.store')->middleware('role:Sales,Manager');

    Route::post('/invite', [InvitationController::class, 'send'])->name('invite.send');
});

// Invitation Accept
Route::get('/invite/{token}', [InvitationController::class, 'accept'])->name('invite.accept'); 
Route::post('/invite-register', [InvitationController::class, 'register'])->name('invite.register'); 
