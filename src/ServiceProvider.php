<?php 

namespace Djzt\SentinelLaravelAuthDriver\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceProvider extends ServiceProvider
{

	public function register()
	{
		$this->app['auth']->extend('djzt-sentinel-auth-driver', function($app) {
            $model = $app['config']['auth.model'];
            return new \Djzt\SentinelLaravelAuthDriver\SentinelLaravelAuthDriver($app['hash'], $model);
        });
	}

}