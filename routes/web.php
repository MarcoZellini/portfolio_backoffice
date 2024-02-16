<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\GitHubController;
use App\Models\Lead;
use App\Mail\NewLeadEmail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('projects/trash', [ProjectController::class, 'trashed'])->name('projects.trash');
    Route::put('projects/{project}/restore', [ProjectController::class, 'restoreTrash'])->name('projects.restore');
    Route::delete('projects/{project}/destroy', [ProjectController::class, 'forceDestroy'])->name('projects.forceDestroy');
    Route::resource('projects', ProjectController::class)->parameters([
        'projects' => 'project:slug'
    ]);
    Route::get('types/trash', [TypeController::class, 'trashed'])->name('types.trash');
    Route::put('types/{type}/restore', [TypeController::class, 'restoreTrash'])->name('types.restore');
    Route::delete('types/{type}/destroy', [TypeController::class, 'forceDestroy'])->name('types.forceDestroy');
    Route::resource('types', TypeController::class)->parameters([
        'types' => 'type:slug'
    ]);

    Route::get('technologies/trash', [TechnologyController::class, 'trashed'])->name('technologies.trash');
    Route::put('technologies/{technology}/restore', [TechnologyController::class, 'restoreTrash'])->name('technologies.restore');
    Route::delete('technologies/{technology}/destroy', [TechnologyController::class, 'forceDestroy'])->name('technologies.forceDestroy');
    Route::resource('technologies', TechnologyController::class)->parameters([
        'technologies' => 'technology:slug'
    ]);

    Route::get('/repositories', [GitHubController::class, 'fetchRepositories'])->name('repositories');
});
