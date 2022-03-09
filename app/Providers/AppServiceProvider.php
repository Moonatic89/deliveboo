<?php

namespace App\Providers;

use Braintree;
use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Gateway::class, function ($app) {
            return new Gateway(
                [

                    'environment' => getenv('BRAINTREE_ENV'),
                    'merchantId' => getenv('BRAINTREE_MERCHANT_ID'),
                    'publicKey' => getenv('BRAINTREE_PUBLIC_KEY'),
                    'privateKey' => getenv('BRAINTREE_PRIVATE_KEY')

                    // CHANGE WITH YOUR STATIC DATA
                    // 'environment' => 'sandbox',
                    // 'merchantId' => 'kvntg6fcgx6pn4v9',
                    // 'publicKey' => 'w55j5pb4c9pvgmvw',
                    // 'privateKey' => 'fbbe3822890f8cd804bbe4bb9c8ce459'
                ]
            );
        });
    }
}