<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\CrfCourseController;
use App\Http\Controllers\Site\IntrestedStudentController;
use App\Http\Controllers\Site\ProgramController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashbaordController;
use App\Http\Controllers\Admin\AccountTreeController;
use App\Http\Controllers\Admin\ContactController as UserContactController;
use App\Http\Controllers\Admin\MeetingController;
use App\Http\Controllers\Admin\ParticipantController;
use App\Http\Controllers\Admin\RecordingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Requests\Site\IntresetedStudentRegisterRequest;

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


Auth::routes(['register' => false]);

Route::middleware('auth:admin')
    ->name('admin.')->group(function () {
        Route::redirect('/', '/admin/dashboard', 301);
        Route::get('/dashboard', [DashbaordController::class, 'dashboard'])->name('dashboard');
        Route::get('/mail-test', [DashbaordController::class, 'testMail'])->name('testmail');

        // Users
        Route::prefix('user')->as('user.')->group(function () {
            Route::get('', [UserController::class, 'index'])->name('index');
            Route::post('store', [UserController::class, 'store'])->name('store');
            Route::post('update/{id}', [UserController::class, 'update'])->name('update');
            Route::post('update/rooms/{user}', [UserController::class, 'updateRooms'])->name('update_rooms');
            Route::get('get/rooms/{user}', [UserController::class, 'getRooms'])->name('get_rooms');
            Route::delete('destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
            Route::get('/status-toggle', [UserController::class, 'toggleStatus'])->name('toggle_status');
            Route::get('table', [UserController::class, 'getTableData'])->name('table');
            Route::get('export/{meeting}', [UserController::class, 'export'])->name('export');
            Route::post('add-user/{meeting}', [ParticipantController::class, 'store'])->name('add_user');
            Route::get('/{meeting}/participants', [ParticipantController::class, 'getParticipants'])->name('get_participants');
            Route::post('/{id}/update-participants', [ParticipantController::class, 'updateParticipants'])->name('update_participants');
        });
        Route::prefix('meetings')->as('meeting.')->group(function () {
            Route::get('', [MeetingController::class, 'index'])->name('index');
            Route::post('store', [MeetingController::class, 'store'])->name('store');
            Route::get('/status-toggle', [MeetingController::class, 'toggleStatus'])->name('toggle_status');
            Route::get('table', [MeetingController::class, 'getTableData'])->name('table');
            Route::get('export/{meeting}', [MeetingController::class, 'export'])->name('export');
            Route::post('add-user/{meeting}', [ParticipantController::class, 'store'])->name('add_user');
            Route::get('/{meeting}/participants', [ParticipantController::class, 'getParticipants'])->name('get_participants');
            Route::post('/{id}/update-participants', [ParticipantController::class, 'updateParticipants'])->name('update_participants');
        });

        Route::prefix('recording')->as('recording.')->group(function () {
            Route::get('', [RecordingController::class, 'index'])->name('index');
            Route::get('all', [RecordingController::class, 'allRecordings'])->name('all');
            Route::get('table', [RecordingController::class, 'getTableData'])->name('table');
            Route::get('all-recordings-table', [RecordingController::class, 'getAllRecordingsTable'])->name('all.table');

        });
    });
