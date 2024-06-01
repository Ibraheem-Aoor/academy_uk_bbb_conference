<?php

namespace App\Http\Middleware;

use App\Models\Meeting;
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
    public function handle(Request $request, Closure $next)
    {
        $meeting = Meeting::query()->findOrFail(decrypt($request->route('meeting')));
        if ($meeting->start_date <= now()->toDateString() && $meeting->end_date != now()->toDateString()) {
            return $next($request);
        }
        return abort(404);
    }
}
