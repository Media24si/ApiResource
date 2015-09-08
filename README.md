# Api Resource

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

A simple Guzzle wrapper, providing easy access to API endpoints.

**For Guzzle v5.0 support use v1.0.0**

## Install - Laravel

Require this package with Composer (Packagist), using the following command:

``` bash
$ composer require media24si/api-resource
```

Register the ApiResourceServiceProvider to the providers array in `config/app.php`:

``` php
Media24si\ApiResource\ApiResourceServiceProvider::class,
```

Publish vendor files (config file):
``` bash
$ php artisan vendor:publish
```

**Optional**
Register the facade in `config/app.php`:
``` php
'Api' => Media24si\ApiResource\Facades\ApiResource::class
```

## Install - Lumen

Require this package with Composer (Packagist), using the following command:

``` bash
$ composer require media24si/api-resource
```

Register the ApiResourceServiceProvider inside `bootstrap/app.php` (Lumen):

``` php
$app->register(Media24si\ApiResource\ApiResourceServiceProvider::class);
```

Copy the config file from the vendor `vendor/media24si/api-resource/src/config/apiresrouce.php` to your local config folder `config/apiresource.php` and enable the config inside your `bootstrap/app.php` (Lumen):
``` php
$app->configure('apiresource');
```

**Optional**
Register the facade in `bootstrap/app.php` (Lumen):
``` php
class_alias(Media24si\ApiResource\Facades\ApiResource::class, 'Api');
```
also, make sure you uncomment this line from the same file:
``` php
$app->withFacades();
```

## Usage

You can use this package without any configuration. Just use the \Api facade in your controller (or inject Media24si\ApiResource\ApiResource in your function/controller).

Call your endpoints, like you would a normal Guzzle request:
``` php
\Api::get('http://httpbin.org'); // returns a response object
```

## Config

#### defaults
Associative array of Request Options, that are applied to every request, created by the client. See the official [manual](http://guzzle.readthedocs.org/en/latest/quickstart.html#creating-a-client) .

Example:
``` php
'defaults' => [
	'base_uri' => 'http://httpbin.org/']
]

#### endpoints
Array of defined endpoints. Here you can define your aliases for endpoints.

Sample array:
``` php
'endpoints' => [
	'notification' => [
		'uri' => 'http://httpbin.org/notification'
	],
	'categories' => [
		'uri' => '/categories', // with base_uri set
		'options' => [
			'query' => [
				'fields' => 'id, title'
			]
		]
	]
]
```

With endpoints defined you can make simple calls. A sample would be:
``` php
\Api::get('notification')
```

Default options can be overridden:
``` php
\Api::get('categories', ['query' => ['fields' => 'id, title, slug']])
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[manual]: http://guzzle.readthedocs.org/en/latest/
