<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        header_remove('X-Powered-By');

        /** @var Response $response */
        $response = $next($request);

        $response->headers->set(
            'Content-Security-Policy',
            implode('; ', [
                "default-src 'self'",
                "base-uri 'self'",
                "frame-ancestors 'self'",
                "form-action 'self'",
                "img-src 'self' data:",
                "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://fonts.googleapis.com https://cdnjs.cloudflare.com",
                "script-src 'self' https://cdn.jsdelivr.net",
                "font-src 'self' https://cdn.jsdelivr.net https://fonts.gstatic.com",
                "connect-src 'self'",
                "object-src 'none'",
                "frame-src 'self'",
                "upgrade-insecure-requests",
            ])
        );

        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        $response->headers->remove('X-Powered-By');

        return $response;
    }
}
