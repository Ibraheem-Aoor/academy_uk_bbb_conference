<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserWebController;
use App\Models\Participant;
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
    Route::group(['prefix' => 'meeting'], function () {
        Route::middleware('is_active_meeting:Meeting')->group(function () {

            Route::get('join/{meeting}/{user}', [HomeController::class, 'joinMeetingShowForm'])->name('join_meeting');
            Route::get('join-public/{meeting}/', [HomeController::class, 'joinPublicMeetingShowForm'])->name('join_public_meeting');
            Route::post('join/{meeting}/{user}', [HomeController::class, 'joinMeeting'])->name('join_meeting.submit');
            Route::post('join-public/{meeting}/', [HomeController::class, 'joinPublicMeeting'])->name('join_public_meeting.submit');
        });
        // user
        Route::prefix('user')->as('user.')->middleware(['is_active_meeting'])->group(function () {
            Route::get('join/{meeting}/{user}', [UserWebController::class, 'joinMeetingShowForm'])->name('join_meeting');
            Route::get('join-public/{meeting}/', [UserWebController::class, 'joinPublicMeetingShowForm'])->name('join_public_meeting');
            Route::post('join/{meeting}/{user}', [UserWebController::class, 'joinMeeting'])->name('join_meeting.submit');
            Route::post('join-public/{meeting}/', [UserWebController::class, 'joinPublicMeeting'])->name('join_public_meeting.submit');
        });
    });

});

Route::get('fix', function () {
    Participant::query()->chunk(100, function ($participants) {
        foreach ($participants as $participant) {
            $participant->bridge_url = str_replace('bbb-conference.hyper-stage.com', 'meet.academy-uk.net', $participant->join_url);
            $participant->save();
        }
    });
    $participants = Participant::get();
    dd($participants);
});
