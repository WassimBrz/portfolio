<?php

use App\Http\Controllers\Admin;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;


Route::get('/', function () {
    return Inertia::render('Home', [
        'author' => 'Wassim Bourhanzour', // votre prénom et votre nom
    ]);
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});
Route::get('projets', [ProjectController::class, 'index'])->name('projects.index');
Route::get('projets/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');

Route::inertia('a-propos', 'About')->name('about');
Route::inertia('contact', 'Contact')->name('contact');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('projets', Admin\ProjectController::class)
        ->except('show')
        ->names('projects')
        ->parameters(['projets' => 'project']);
});

require __DIR__.'/settings.php';
