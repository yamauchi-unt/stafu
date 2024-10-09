<?php

namespace YamauchiUnt\Stafu\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\IpUtils;
use Symfony\Component\HttpFoundation\Response;

class CheckIp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // IPホワイトリスト取得
        $ipWhitelist = config("ip_whitelist.$role");

        // IPアドレス判定
        if (!IpUtils::checkIp($request->ip(), $ipWhitelist)) {
            // ログ出力
            Log::warning('Unauthorized IP request', [
                'ip' => $request->ip(),
                'role' => $role
            ]);

            throw new AuthorizationException();
        }

        return $next($request);
    }
}
