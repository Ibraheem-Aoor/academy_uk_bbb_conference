<?php

namespace App\Http\Middleware\User;

use App\Models\User\UserMeeting;
use Closure;
use Illuminate\Http\Request;

class MaxParticipantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $meeting = UserMeeting::query()->where('meeting_id' , ($request->route('meeting')))->firstOrFail();
        dd($meeting);
        return $next($request);
    }
}
