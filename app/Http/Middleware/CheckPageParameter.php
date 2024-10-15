<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CheckPageParameter
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra nếu tham số truy vấn "page" là 1
        if ($request->query('page') == 1) {
            // Chuyển hướng về URL không có tham số truy vấn "page"
            return Redirect::to($request->url());
        }

        // Nếu không phải trường hợp "page" là 1, tiếp tục xử lý yêu cầu
        return $next($request);
    }
}