<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Http\Livewire\CreateTask;
use App\Http\Livewire\CreateTaskGroup;
use App\Http\Livewire\TaskGroupList;
use App\Http\Livewire\TaskList;
use App\Http\Controllers\MarkdownController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])->group(function () {

    Route::get('/', function () { return view('dashboard'); });

    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

    Route::get('/tasks', TaskList::class)->name('tasks');

    Route::get('/taskgroups', TaskGroupList::class)->name('taskgroups');

//     Route::get('/readme', [MarkdownController::class, 'show']);
    
});




