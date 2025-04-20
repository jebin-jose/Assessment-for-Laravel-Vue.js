<?php


use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\Jobs\{Index,Create};
use App\Livewire\Pages\Skills\{Index as SkillsIndex};
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/dashboard');

// Dashboard
Route::get('/dashboard', Dashboard::class)->name('dashboard');

// Skills
Route::get('/skills', SkillsIndex::class)->name('skills.index');

// Jobs
Route::prefix('jobs')->name('jobs.')->group(function () {
    Route::get('/', Index::class)->name('index');
    Route::get('/create', Create::class)->name('create');
});

