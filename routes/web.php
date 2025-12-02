<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\PigController;
use App\Http\Controllers\FeedController;



Route::get('/dashboard', [PigController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('pigs', PigController::class);
    Route::get('/pigs/create', [PigController::class, 'create'])->name('pigs.create');
    Route::post('/pigs/store', [PigController::class, 'store'])->name('pigs.store');
    Route::get('/pigs/{pig}/edit', [PigController::class, 'edit'])->name('pigs.edit');
    Route::delete('/pigs/{pig}', [PigController::class, 'destroy'])->name('pigs.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('feeds', FeedController::class);
    Route::get('/pigfeeds', [FeedController::class, 'index'])->name('pigfeeds'); // feed list page
    Route::get('/feeds/{feed}/edit', [FeedController::class, 'edit'])->name('feeds.edit'); // edit page
    Route::put('/feeds/{feed}', [FeedController::class, 'update'])->name('feeds.update'); // update
    Route::delete('/feeds/{feed}', [FeedController::class, 'destroy'])->name('feeds.destroy'); // delete

});


Route::get('/', function () {
    return view('welcome');
})->name('home');

//Route::view('dashboard', 'dashboard')
//->middleware(['auth', 'verified'])
// ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
