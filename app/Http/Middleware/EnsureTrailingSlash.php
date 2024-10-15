<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureTrailingSlash
{
    public function handle(Request $request, Closure $next)
    {
        $url = $request->url();

        if (substr($url, -1) !== '/') {
            // Nếu URL không kết thúc bằng '/', chuyển hướng đến URL có dấu '/'
            return redirect($url . '/');
        }

        return $next($request);
    }
}