<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user instanceof User || !$user->is_admin) {
            return response()->json([
                'message' => 'Unauthorized action.',
            ], 403);
        }

        return $next($request);
    }
}
