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


// Route::redirect('/','admin/dashboard');
// Site Routes
Route::group([
    'as' => 'site.'
], function () {
    Route::get('meeting/join/{meeting}/{user}', [HomeController::class, 'joinMeetingShowForm'])->name('join_meeting');
    Route::post('meeting/join/{meeting}/{user}', [HomeController::class, 'joinMeeting'])->name('join_meeting.submit');
});
