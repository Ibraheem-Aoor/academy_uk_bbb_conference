<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\DashboardController;
use App\Models\Participant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MeetingController;
use App\Http\Controllers\User\ParticipantController;
use App\Http\Controllers\User\UserMeetingController;
use App\Http\Controllers\User\UserPlanController;
use App\Http\Controllers\User\UserRecordingController;
use App\Services\UserPlanService;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!b
|
*/
Auth::routes(['register' => false]);

Route::middleware('auth:web')->group(function () {
    Route::redirect('/', '/user/home', 301);
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::post('/home/update-room/{room}', [DashboardController::class, 'updateRoom'])->name('update_room');
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::prefix('meetings')->as('meeting.')->group(function () {
        Route::get('', [UserMeetingController::class, 'index'])->name('index');
        Route::post('store', [UserMeetingController::class, 'store'])->name('store');
        Route::post('store/quick', [UserMeetingController::class, 'quickStore'])->name('create_quick');
        Route::get('/status-toggle', [UserMeetingController::class, 'toggleStatus'])->name('toggle_status');
        Route::get('table', [UserMeetingController::class, 'getTableData'])->name('table');
        Route::get('export/{meeting}', [UserMeetingController::class, 'export'])->name('export');
        Route::post('add-user/{meeting}', [ParticipantController::class, 'store'])->name('add_user');
        Route::get('/{meeting}/participants', [ParticipantController::class, 'getParticipants'])->name('get_participants');
        Route::post('/{id}/update-participants/', [ParticipantController::class, 'updateParticipants'])->name('update_participants');
    });
    // User Subscription
    Route::prefix('subscription')->as('plan.')->group(function () {
        Route::get('', [UserPlanController::class, 'index'])->name('index');
    });
    Route::prefix('recording')->as('recording.')->group(function () {
        Route::get('', [UserRecordingController::class, 'index'])->name('index');
        Route::get('all', [UserRecordingController::class, 'allRecordings'])->name('all');
        Route::get('table', [UserRecordingController::class, 'getTableData'])->name('table');

    });
});
