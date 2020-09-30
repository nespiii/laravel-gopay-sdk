<?php
/**
 * Created by Damián Imrich / Haze Studio.
 * Date: 22.11.2016
 * Time: 14:45
 */

namespace Nespiii\LaravelGoPaySDK;

use Nespiii\LaravelGoPaySDK\Events\PaymentCreated;
use Illuminate\Support\ServiceProvider;

class GopayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config.php' => config_path('gopay.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if(is_dir($vendor = __DIR__.'/../vendor')){
            require_once $vendor.'/autoload.php';
        }

        $this->mergeConfigFrom(
            __DIR__.'/config.php', 'gopay'
        );
        
        $this->app->singleton('GopaySDK', function ($app) {
            return new GoPaySDK();
        });
    }
}