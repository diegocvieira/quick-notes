<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\NoteController as AdminNoteController;
use App\Http\Controllers\NoteController;

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

Route::get('/', [NoteController::class, 'index']);

Route::prefix('admin/notes')->name('note.')->controller(AdminNoteController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create','create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{note}/edit', 'edit')->name('edit');
    Route::put('/{note}', 'update')->name('update');
});
