<?php

namespace App\Http\Middleware;

use App\Models\Storage;
use Closure;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class CheckStorageAccess
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Gate::allows('access-storage', $request->storage)) {
            return $next($request, $request->user());
        }
        return abort(403);
    }
}
