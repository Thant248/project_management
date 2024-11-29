<?php

use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\userController;
use App\Mail\InvitationMail;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Monolog\Handler\RotatingFileHandler;


Route::redirect('/', '/dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashBoardController::class, 'index'] )->name('dashboard');

    Route::resource('project', ProjectController::class);
    Route::get('task/my-tasks', [TaskController::class, 'myTasks'])->name('task.my-tasks');
    Route::resource('task', TaskController::class);
    Route::resource('user', userController::class);
    Route::get('invite', [InvitationController::class, 'index'])->name('invite.index');
    Route::post('invite', [InvitationController::class, 'store'])->name('invite.store');
    Route::get('user-qrcode', [QRCodeController::class, 'index'])->name('qr.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
