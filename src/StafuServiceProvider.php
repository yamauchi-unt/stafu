<?php

namespace YamauchiUnt\Stafu;

use Illuminate\Support\ServiceProvider;
use YamauchiUnt\Stafu\Http\Middleware\CheckIp;
use YamauchiUnt\Stafu\Http\Middleware\CustomBasicAuth;

class StafuServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/ip_whitelist.php', 'ip_whitelist'
        );
        $this->mergeConfigFrom(
            __DIR__.'/../config/basic_auth.php', 'basic_auth'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $router = $this->app['router'];
        $router->aliasMiddleware('check_ip', CheckIp::class);
        $router->aliasMiddleware('basic_auth', CustomBasicAuth::class);

        $this->publishes([
            __DIR__.'/../config/ip_whitelist.php' => config_path('ip_whitelist.php'),
            __DIR__.'/../config/basic_auth.php' => config_path('basic_auth.php'),
        ], 'stafu');
    }
}
