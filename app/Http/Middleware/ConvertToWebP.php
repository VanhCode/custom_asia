<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ConvertToWebP
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        if ($response->headers->get('content-type') === 'image/png') {
            // Đọc ảnh từ response
            $image = Image::make($response->getContent());
            // dd($image);
            // Chuyển đổi sang định dạng WebP
            $webpContent = $image->encode('webp')->getEncoded();

            // Cập nhật response với định dạng WebP
            $response->header('Content-Type', 'image/webp');
            $response->setContent($webpContent);
        }

        return $response;
    }
}