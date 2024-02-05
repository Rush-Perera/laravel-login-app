<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // app/Http/Middleware/UserType.php

public function handle(Request $request, Closure $next, ...$types)
{
    $user = $request->user();

    if (in_array($user->user_type, $types)) {
        return $next($request);
    }

    abort(403, 'Unauthorized action.');
}

}
