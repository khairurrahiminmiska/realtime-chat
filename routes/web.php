<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;
use App\Models\Message;
use App\Http\Controllers\GroupController;

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Chat
Route::middleware('auth')->group(function () {

    Route::get('/chat', [ChatController::class, 'index']);
    Route::post('/chat/send', [ChatController::class, 'send']);
    Route::post('/group/create', [GroupController::class, 'create']);
    Route::get('/group/{id}', [GroupController::class, 'show']);
    Route::post('/group/send', [GroupController::class, 'send']);

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/messages', function () {
    return Message::latest()->get();
});
});

require __DIR__.'/auth.php';

