<?php namespace Media24si\ApiResource\Facades;

use Illuminate\Support\Facades\Facade;

class ApiResource extends Facade {

	protected static function getFacadeAccessor() { return 'Media24si\ApiResource\ApiResource'; }

}