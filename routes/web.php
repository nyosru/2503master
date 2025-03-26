<?php

use Illuminate\Support\Facades\Route;

//Route::view('/', 'welcome');
Route::get('', \App\Livewire\Index::class)->name('enter');
Route::get('bo', \App\Livewire\Cms2\Leed\LeedBoard::class)->name('leeds');

//Route::view('dashboard', 'dashboard')
//    ->middleware(['auth', 'verified'])
//    ->name('dashboard');
//
//Route::view('profile', 'profile')
//    ->middleware(['auth'])
//    ->name('profile');

require __DIR__.'/auth.php';
