<?php

namespace App\Http\Middleware;

use App\Models\Meeting;
use App\Models\User\UserMeeting;
use Closure;
use Illuminate\Http\Request;

class IsActiveMeeting
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next , $model = null)
    {
        if($model == 'Meeting'){
            $meeting = Meeting::query()->findOrFail(decrypt($request->route('meeting')));
        }else{
            $meeting = UserMeeting::query()->where('meeting_id' , ($request->route('meeting')))->firstOrFail();
        }
        return $meeting->status ? $next($request) : abort(404);
    }
}
