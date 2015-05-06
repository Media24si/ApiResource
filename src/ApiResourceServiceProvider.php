<?php namespace Media24si\ApiResource;

use Illuminate\Support\ServiceProvider;

class ApiResourceServiceProvider extends ServiceProvider  {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__.'/config/apiresource.php' => config_path('apiresource.php'),
		]);
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('Media24si\ApiResource\ApiResource', 'Media24si\ApiResource\ApiResource');
	}

}