<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GoogleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \Storage::extended("google", function ($app, $config){
            $client = new \Google_Client;
            $client->setClientId(config['clientId']);
            $client->setClientSecret(config['clientSecret']);
            $client->refreshToken(config['refreshToken']);
        });
//        $client = new \Google_Client;
//        dd($client);
    }
}
