<?php

namespace Wuwx\LaravelSupervisor;

use Illuminate\Support\ServiceProvider;
use Supervisor\Supervisor;
use Supervisor\Connector\Zend;
use Zend\XmlRpc\Client;

class SupervisorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('supervisor', function ($app) {
            $client = new Client('http://127.0.0.1:9001/RPC2');
            $client->getHttpClient()->setAuth('user', '123');

            $connector = new Zend($client);
            $supervisor = new Supervisor($connector);
            return $supervisor;
        });
    }
}
