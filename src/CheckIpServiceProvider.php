<?php

namespace YamauchiUnt\Stafu;

use Illuminate\Support\ServiceProvider;
use YamauchiUnt\Stafu\Http\Middleware\CheckIp;

class CheckIpServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/ip_whitelist.php', 'ip_whitelist'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $router = $this->app['router'];
        $router->aliasMiddleware('check_ip', CheckIp::class);

        $this->publishes([
            __DIR__.'/../config/ip_whitelist.php' => config_path('ip_whitelist.php'),
        ], 'ip_whitelist');
    }
}
