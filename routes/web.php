<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


// Site Routes
Route::group([
    'as' => 'site.'
], function () {
    // Join Meeting Routes.
    Route::group(['prefix' => 'meeting', 'middleware' => ['is_active_meeting']], function () {
        Route::get('join/{meeting}/{user}', [HomeController::class, 'joinMeetingShowForm'])->name('join_meeting');
        Route::get('join-public/{meeting}/', [HomeController::class, 'joinPublicMeetingShowForm'])->name('join_public_meeting');
        Route::post('join/{meeting}/{user}', [HomeController::class, 'joinMeeting'])->name('join_meeting.submit');
        Route::post('join-public/{meeting}/', [HomeController::class, 'joinPublicMeeting'])->name('join_public_meeting.submit');
    });
});
