<?php

namespace YamauchiUnt\Stafu\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class CustomBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        $userId = config("basic_auth.$roles.user_id");
        $password = config("basic_auth.$roles.password");

        // Basic認証
        if ($request->getUser() !== $userId || !Hash::check($request->getPassword(), $password)) {
            // 認証失敗時のログ出力
            Log::warning('Unauthorized BasicAuth attempt', [
                'ip' => $request->ip(),
                'user' => $request->getUser(),
                'roles' => $roles,
            ]);

            return response('Unauthorized', Response::HTTP_UNAUTHORIZED, ['WWW-Authenticate' => 'Basic']);
        }

        return $next($request);
    }
}
